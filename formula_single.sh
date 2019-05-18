#!/bin/bash

songfile=$1
comparefile=$2

suffix="song.txt"
songdir=$(echo $songfile | sed -e "s/$suffix$//")
datatypes="${songdir}dataTypes.txt"
datatypes=$(cat $datatypes)

echo "$datatypes" | while read line; do

    if [ "$line" == "scales" ]; then echo scales

        elif [ "$line" == "key-signature" ]; then echo key-signature
            cat "${songdir}data/key-signature/occurrences-values.txt"
            printf "\n"
        elif [ "$line" == "average-pitch" ]; then echo average-pitch

        elif [ "$line" == "average-steps" ]; then echo average-steps

        elif [ "$line" == "most-used-pitches" ]; then echo most-used-pitches

        elif [ "$line" == "average-note-value" ]; then echo average-note-value

        elif [ "$line" == "repeated-note-value" ]; then echo repeated-note-value

        elif [ "$line" == "repeated-pitches" ]; then echo repeated-pitches

        elif [ "$line" == "time-signature" ]; then echo time-signature

        elif [ "$line" == "most-used-note-value" ]; then echo most-used-note-value

    fi

done
