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

        if [ $val2 = 0 ]; then
            if [ $val1 != 0 ]; then
                val2=.5
            fi
        elif [ $val1 = 0 ]; then
            if [ $val2 != 0 ]; then
                val1=0.5
            fi
        fi

        if [ $val1 = 0 ]; then
            if [ $val2 = 0 ]; then
                echo 1
            elif (( $(echo "$val1 > $val2" | bc -l) ))  ; then
                echo "scale=5;$val2/$val1" | bc -l
            else
                echo "scale=5;$val1/$val2" | bc -l
            fi
        elif (( $(echo "$val1 > $val2" | bc -l) )); then
            echo "scale=5;$val2/$val1" | bc -l
        else
            echo "scale=5;$val1/$val2" | bc -l
        fi
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
#==============================================



# Loop through each line of the amalgamated data file. 
# Based on the current metric, execute the functions.
    while read line; do
        analysisName=$(echo $line | cut -d ':' -f1)
        compareLine=$(grep "$analysisName" $comparefile)

        if [ $analysisName == "scales" ]; then
            scales $line $compareLine
        elif [ $analysisName == "average-pitch" ]; then
            averagePitch $line $compareLine
        fi
    done < $songfile
#=======================================================

