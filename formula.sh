#!/bin/bash


# Define the file vars:
    songfile=$1
    comparefile=$2
    lines=$(cat $songfile | wc -l)
#========================

# Define threshold:
#==================
    threshold=0.5
#==================


#Define the mathematical functions below: ======================
    function percentError {
        val1=$1
        val2=$2

        # if [ $val2 = 0 ]; then
        #     if [ $val1 != 0 ]; then
        #         val2=.5
        #     fi
        # elif [ $val1 = 0 ]; then
        #     if [ $val2 != 0 ]; then
        #         val1=0.5
        #     fi
        # fi
        
        
        
        return=
        if [ $val1 = 0 ]; then
            if [ $val2 = 0 ]; then
                return=1
            fi 
        fi

        if [ "$return" != "1" ]; then
            if (( $(echo "$val1 > $val2" | bc -l) )); then
                return=$(echo "scale=3;$val2/$val1" | bc -l)
            else
                return=$(echo "scale=3;$val1/$val2" | bc -l)
            fi
        fi

        echo $return
    }
#=============================================================

# Define the metric functions below: =========
    function scales {
        for i in {1..28}; do
            data=$(echo $1 | cut -d ';' -f${i})
            compareData=$(echo $2 | cut -d ';' -f${i})
            scaleError="$scaleError$(percentError $data $compareData)\n"
        done

        scaleErrorSum=$(printf $scaleError | paste -sd+ - | bc -l)
        echo "scale=4;$scaleErrorSum/28" | bc -l
    }

    function average-pitch {
        data=$(echo $1 | cut -d ';' -f1)
        compareData=$(echo $2 | cut -d ';' -f1)
        percentError $data $compareData
    }

    function average-note-value {
        data=$(echo $1 | cut -d ';' -f1)
        compareData=$(echo $2 | cut -d ';' -f1)
        percentError $data $compareData
    }

    function average-steps {
        for i in {1..3}; do
            data=$(echo "$1" | cut -d ';' -f${i})
            compareData=$(echo "$2" | cut -d ';' -f${i})
            stepsError="$stepsError$(percentError $data $compareData)\n"
        done

        abs=$(printf $stepsError | sed '1q;d')
        neg=$(printf $stepsError | sed '2q;d')
        firstLast=$(printf $stepsError | sed '3q;d')

        abs=$(echo "$abs * 0.35" | bc -l )
        neg=$(echo "$neg * 0.55" | bc -l )
        firstLast=$(echo "$firstLast * 0.1" | bc -l )
        echo "${abs}+${neg}+${firstLast}" | bc -l
    }

    function repeated-pitches {
        for i in {1..6}; do
            data=$(echo "$1" | cut -d ';' -f${i})
            compareData=$(echo "$2" | cut -d ';' -f${i})
            repPitchError="$repPitchError$(percentError $data $compareData)\n"
        done

        repPitchErrorSum=$(printf $repPitchError | paste -sd+ - | bc -l)
        echo "scale=4;$repPitchErrorSum/7" | bc -l
    }

    function repeated-note-value {
        for i in {1..8}; do
            data=$(echo "$1" | cut -d ';' -f${i})
            compareData=$(echo "$2" | cut -d ';' -f${i})
            repValueError="$repValueError$(percentError $data $compareData)\n"
        done

        repValueErrorSum=$(printf $repValueError | paste -sd+ - | bc -l)
        echo "scale=4;$repValueErrorSum/8" | bc -l
    }
    function most-used-note-value {
        percent=$(echo $1 | tr ';' '\n' | tail -n 6)
        comparePercent=$(echo $2 | tr ';' '\n' | tail -n 6)

        num=`echo $(echo "$percent" | wc -l)-1 | bc`
        compareNum=`echo $(echo "$comparePercent" | wc -l)-1 | bc`

        for i in $(seq $num); do
            j=$(echo $i+1 | bc)
            val1=$(echo "$percent" | sed "${i}q;d") 
            val2=$(echo "$percent" | sed "${j}q;d" )
            ratio="$ratio$(echo $val1/$val2 | bc -l)\n"
        done
        sum=$(printf "$ratio" | paste -sd+ - | bc)
        average=$(echo $sum/$num | bc -l)

        for i in $(seq $compareNum); do
            j=$(echo $i+1 | bc)
            val1=$(echo "$percent" | sed "${i}q;d") 
            val2=$(echo "$percent" | sed "${j}q;d" )
            ratioCompare="$ratioCompare$(echo $val1/$val2 | bc -l)\n"
        done
        sumCompare=$(printf "$ratioCompare" | paste -sd+ - | bc)
        averageCompare=$(echo $sumCompare/$compareNum | bc -l)

        first=$(echo "$percent" | head -n1)
        last=$(echo "$percent" | tail -n1)
        compareFirst=$(echo "$comparePercent" | head -n1)
        compareLast=$(echo "$comparePercent" | tail -n1)

        first=$(percentError $first $compareFirst)
        last=$(percentError $last $compareLast)
        ratio=$(percentError $average $averageCompare)
        averageone=$(echo "($ratio + $first + $last)/3" | bc -l)

        data=$(echo $1 | cut -d ';' -f-5)
        comparedata=$(echo $2 | cut -d ';' -f-5)
        averagetwo=$(comparePlaces $data $comparedata)
        echo "($averageone + $averagetwo)/2" | bc -l
    }
    function time-signature {
        top=$(echo $1 | cut -d '/' -f1)
        topcompare=$(echo $2 | cut -d '/' -f1)
        topError=$(percentError $top $topcompare)

        bottom=$(echo $1 | cut -d '/' -f2 | tr -d ';')
        bottomcompare=$(echo $2 | cut -d '/' -f2 | tr -d ';')
        bottomError=$(percentError $bottom $bottomcompare)
        echo "($topError + $bottomError)/2" | bc -l
    }


    function comparePlaces {
        data=$(echo "$1" | tr ';' '\n')
        compareData=$(echo "$2" | tr ';' '\n')
        valnums=$(echo "$1" | tr ';' '\n' | wc -l)
        combined=$(echo "$(echo $1);$2" | tr ';' '\n')

        unique=$(echo "$combined" | sort -n | uniq)
        uniqLines=$(echo "$unique" | wc -l)
        
        result=
        for i in $unique; do
            multi=$(echo "$combined" | grep $i | wc -l)
            if [ $multi -eq "2" ]; then
                val1=$(echo "$data" | grep -n $i | cut -d ':' -f1)
                val2=$(echo "$compareData" | grep -n $i | cut -d ':' -f1)
                result="$result$(percentError $val1 $val2)\n"
            else
                result="$result$(echo 0)\n"
            fi
            # echo $result
        done
        sum=$(printf $result | paste -sd+ - | bc)
        echo $sum/$uniqLines | bc -l
    }
#==============================================



# Loop through each line of the amalgamated data file. 
# Based on the current metric, execute the functions.
    while read -r line; do
        analysisName=$(echo $line | cut -d ':' -f1)
        compareLine=$(grep "$analysisName" $comparefile | cut -d ':' -f2)
        line=$(echo $line | cut -d ':' -f2)
        # printf "\n"
        # echo $analysisName
        $analysisName $line $compareLine
        # if [ $analysisName == "scales" ]; then
        #     scales $line $compareLine
        # elif [ $analysisName == "average-pitch" ]; then
        #     average-pitch $line $compareLine
        # elif [ $analysisName == "average-note-value" ]; then
        #     average-note-value $line $compareLine
        # elif [ $analysisName == "average-steps" ]; then
        #     average-steps $line $compareLine
        # elif [ $analysisName == "average-steps" ]; then
        #     average-steps $line $compareLine
        # elif [ $analysisName == "repeated-pitches" ]; then
        #     repeated-pitches $line $compareLine
        # elif [ $analysisName == "repeated-note-value" ]; then
        #     repeated-note-value $line $compareLine
        # elif [ $analysisName == "most-used-note-value" ]; then
        #     most-used-note-value $line $compareLine
        # fi
    done < $songfile
#=======================================================


