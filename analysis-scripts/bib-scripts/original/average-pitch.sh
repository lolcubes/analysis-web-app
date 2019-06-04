#!/bin/bash

file=$1

suffix="song.txt"
removed=$(echo $file | sed s/${suffix}$//)
deg=${removed}deg.txt
output="${removed}data/average-pitch/pitch.txt"
movingOutput="${removed}data/average-pitch/pitch-moving-average.txt"

# Prepares the file by turning it into a single column list of numbers to be processed
filePrep=$(cat $deg | grep -v '=' | grep -v '*' | grep -v '!' | grep -v 'r' | tr -d '^' | tr -d 'v' | tr -d . | tr '\t' '\n' | tr ' ' '\n' | grep . );

# Converts the scale degree into numbers
tradeDecim=$( echo "$filePrep" | sed '/^$/d' | sed 's/+/.5/g' | sed 's/1-/0.5/g' | sed 's/2-/1.5/g' | sed 's/3-/2.5/g' | sed 's/4-/3.5/g' | sed 's/5-/4.5/g' | sed 's/6-/5.5/g' | sed 's/7-/6.5/g' | grep -v '>' | grep '[0-9]' | grep -v '[a-z]' | grep -v '[A-Z]' | sed 's/[^0-9]*//g' | grep .);

echo "$tradeDecim" > $movingOutput

# Sums the converted numbers
sumDecim=$(echo "$tradeDecim" | tr '\n' '+' | awk '{print $0"0"}' | bc -l);

# Finds number of notes in song
totalLines="$(echo "$filePrep" | wc -l)";

lineCountHalf=$(echo "scale=0;$totalLines/2" | bc -l)

bash /var/www/html/analysis-scripts/other/moving-average.sh "$( cat $movingOutput)" $lineCountHalf | paste -sd, - | tr -d '\n' > $movingOutput

# Divides the sum of the pitches by the number of notes for an average

bc -l <<< $sumDecim/$totalLines > $output