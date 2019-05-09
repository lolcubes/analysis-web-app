#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/total-time/time.txt"

/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/gettime -T $file | tr '\t' '~' | cut -d '~' -f2 | tr -d '\n'> $output