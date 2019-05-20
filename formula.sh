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
                return=$(echo "scale=5;$val2/$val1" | bc -l)
            else
                return=$(echo "scale=5;$val1/$val2" | bc -l)
            fi
        fi

        echo $return
    }

#=============================================================

# Define the metric functions below: =========
    function scales {
        datas=$(echo $1 | cut -d ':' -f2)
        compareDatas=$(echo $2 | cut -d ':' -f2)
        for i in {1..28}; do
            data=$(echo "$datas" | cut -d ';' -f${i})
            compareData=$(echo "$compareDatas" | cut -d ';' -f${i})
            scaleError="$scaleError$(percentError $data $compareData)\n"
        done

        scaleErrorSum=$(printf $scaleError | tr '\n' '+' | rev | cut -c 2- | rev | bc -l)
        value=$(echo "scale=4;$scaleErrorSum/28" | bc -l)
        if (( $(echo "$value > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }

    function averagePitch {
        data=$(echo $1 | cut -d ':' -f2 | cut -d ';' -f1)
        compareData=$(echo $2 | cut -d ':' -f2 | cut -d ';' -f1)
        avPitchError=$(percentError $data $compareData)
        if (( $(echo "$avPitchError > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }

    function averageNoteValue {
        data=$(echo $1 | cut -d ':' -f2 | cut -d ';' -f1)
        compareData=$(echo $2 | cut -d ':' -f2 | cut -d ';' -f1)
        avValueError=$(percentError $data $compareData)
        if (( $(echo "$avValueError > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }

    function averageSteps {
        datas=$(echo $1 | cut -d ':' -f2)
        compareDatas=$(echo $2 | cut -d ':' -f2)

        for i in {1..3}; do
            data=$(echo "$datas" | cut -d ';' -f${i})
            compareData=$(echo "$compareDatas" | cut -d ';' -f${i})
            stepsError="$stepsError$(percentError $data $compareData)\n"
        done
        abs=$(printf $stepsError | sed '1q;d')
        neg=$(printf $stepsError | sed '2q;d')
        firstLast=$(printf $stepsError | sed '3q;d')

        abs=$(echo "$abs * 0.35" | bc -l )
        neg=$(echo "$neg * 0.55" | bc -l )
        firstLast=$(echo "$firstLast * 0.1" | bc -l )
        value=$(echo "${abs}+${neg}+${firstLast}" | bc -l)
        if (( $(echo "$value > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }

    function repeatedPitches {
        datas=$(echo $1 | cut -d ':' -f2)
        compareDatas=$(echo $2 | cut -d ':' -f2)
        for i in {1..6}; do
            data=$(echo "$datas" | cut -d ';' -f${i})
            compareData=$(echo "$compareDatas" | cut -d ';' -f${i})
            repPitchError="$repPitchError$(percentError $data $compareData)\n"
        done

        repPitchErrorSum=$(printf $repPitchError | tr '\n' '+' | rev | cut -c 2- | rev | bc -l)
        value=$(echo "scale=4;$repPitchErrorSum/7" | bc -l)
        if (( $(echo "$value > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }

    function repeatedNoteValue {
        datas=$(echo $1 | cut -d ':' -f2)
        compareDatas=$(echo $2 | cut -d ':' -f2)
        for i in {1..8}; do
            data=$(echo "$datas" | cut -d ';' -f${i})
            compareData=$(echo "$compareDatas" | cut -d ';' -f${i})
            repValueError="$repValueError$(percentError $data $compareData)\n"
        done

        repValueErrorSum=$(printf $repValueError | tr '\n' '+' | rev | cut -c 2- | rev | bc -l)
        value=$(echo "scale=4;$repValueErrorSum/8" | bc -l)
        if (( $(echo "$value > $threshold" | bc -l) )); then
            echo '1'
        else
            echo '0'
        fi
    }
    function mostUsedNoteValue {
        echo 'hi'
    }
#==============================================



# Loop through each line of the amalgamated data file. 
# Based on the current metric, execute the functions.
    while read -r line; do
        analysisName=$(echo $line | cut -d ':' -f1)
        compareLine=$(grep "$analysisName" $comparefile)

        if [ $analysisName == "scales" ]; then
            scales $line $compareLine
        elif [ $analysisName == "average-pitch" ]; then
            averagePitch $line $compareLine
        elif [ $analysisName == "average-note-value" ]; then
            averageNoteValue $line $compareLine
        elif [ $analysisName == "average-steps" ]; then
            averageSteps $line $compareLine
        elif [ $analysisName == "average-steps" ]; then
            averageSteps $line $compareLine
        elif [ $analysisName == "repeated-pitches" ]; then
            repeatedPitches $line $compareLine
        elif [ $analysisName == "repeated-note-value" ]; then
            repeatedNoteValue $line $compareLine
        elif [ $analysisName == "most-used-note-value" ]; then
            mostUsedNoteValue $line $compareLine
        fi
    done < $songfile
#=======================================================


