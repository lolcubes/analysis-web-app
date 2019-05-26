#!/bin/bash


# Define the file vars:
    songfile=$1
    comparefile=$2
    removed=$(echo $songfile | rev | cut -c 22- | rev)
    composer=$(echo $comparefile | cut -d '/' -f3)
    genoutput="${removed}/comparison-outputs/averages/$composer.txt"

#========================

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
function normal {
    num=$(echo "$1" | tr ';' '\n' | grep . | wc -l)
    num2=$(echo "$2" | tr ';' '\n' | grep . | wc -l)

    one=$(echo "$1" | tr ';' '\n' | grep .)
    two=$(echo "$2" | tr ';' '\n' | grep .)




    if [ $num -ne $num2 ]; then
        echo not
    else
        for i in $(seq $num); do
            data=$(echo "$one" | sed "${i}q;d")
            compdata=$(echo "$two" | sed "${i}q;d")
            percentError $data $compdata
        done
    fi
}

#==============================================



# Loop through each line of the amalgamated data file. 
# Based on the current metric, execute the functions.
    result=
    while read -r line; do
    
        analysisName=$(echo $line | cut -d ':' -f1)
        compareLine=$(grep "$analysisName" $comparefile | cut -d ':' -f2)
        line=$(echo $line | cut -d ':' -f2)
        # result="$result$(normal $line $compareLine)\n"
        normal $line $compareLine

    done < $songfile 

    # printf $result
    # echo "$(printf $result | grep . | paste -sd+ - | bc -l) / 10" | bc -l #> $genoutput

    # result=$(awk '$0==($0+0)' $output )
    # sum=$(echo "$result" | paste -sd+ - | bc -l)
    # echo $sum/$lines | bc -l > $genoutput
    
    
#=======================================================