#!/bin/bash

file=$1  # Captures input of kern file

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/average-note-value/value.txt"
movingOutput="${removed}data/average-note-value/moving-average.txt"

rhythmList=$(cat $file | tr '\t' '\n' | grep -v '=' | grep -v '*' | grep -v '!' | grep -o '[[:digit:]]*' | grep .  )  # Turns the kern file into a list of numbers that indicate rhythm for each note
rhythmListRecip=$( echo "$rhythmList" | sed 's/^/1\//')

sumSym=$(echo "$rhythmList" | tr '\n' "+")  # Replaces the newline characters with addition signs

lineCount=$(echo "$rhythmList" | wc -l )    # Gets a count of the number of notoes in the piece

summed=$(echo "${sumSym}0" | bc -l)         # Evaluates the sumSym expression

echo $lineCount / $summed | bc -l > $output          # Evaluates the division of number of notes and the total length of the notes

#====================================

lineCountHalf=$(echo "scale=0;$lineCount/2" | bc -l)

bash /Applications/MAMP/htdocs/NewTestings/analysis-scripts/other/moving-average.sh "$rhythmListRecip" $lineCountHalf | tr '\n' ',' | rev | cut -c 2- | rev | tr -d '\n' > $movingOutput
