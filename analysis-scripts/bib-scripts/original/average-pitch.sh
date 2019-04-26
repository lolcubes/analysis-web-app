#!/bin/bash

file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/average-pitch/pitch.txt"
# Prepares the file by turning it into a single column list of numbers to be processed
filePrep=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '=' | grep -v '*' | grep -v '!' | grep -v 'r' | tr -d '^' | tr -d 'v' | tr -d . | tr '\t' '\n' | tr ' ' '\n' | grep .);
# Converts the scale degree into numbers
tradeDecim=$( echo "$filePrep" | sed '/^$/d' | sed 's/+/.5/g' | sed 's/1-/0.5/g' | sed 's/2-/1.5/g' | sed 's/3-/2.5/g' | sed 's/4-/3.5/g' | sed 's/5-/4.5/g' | sed 's/6-/5.5/g' | sed 's/7-/6.5/g');

# Sums the converted numbers
sumDecim=$(echo "$tradeDecim" | tr '\n' '+' | awk '{print $0"0"}' | bc -l);

# Finds number of notes in song
totalLines="$(echo "$filePrep" | wc -l)";

# Divides the sum of the pitches by the number of notes for an average
bc -l <<< $sumDecim/$totalLines > $output

