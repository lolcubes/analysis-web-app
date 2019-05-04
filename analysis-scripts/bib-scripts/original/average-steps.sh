#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/average-steps/"

fileprep=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep '.' | grep -v '!' | grep -v '*' | grep -v '=' | grep -o '[[:digit:]]*' | grep '.' | perl -lne 'if ($.==1){$p=$_} else{print "$p ".($_-$p); $p=$_} END{print $p}' | tr ' ' '~' | cut -d '~' -f2)
divideBy=$( echo "$fileprep" | wc -l)
includingNegativesSum=$( echo "$fileprep" | tr '\n' '+' | awk '{print $0"0"}' | bc -l)
absoluteValueSum=$( echo "$fileprep" | tr -d '-'  | tr '\n' '+' | awk '{print $0"0"}' | bc -l)
absoluteValueEvaluate=$(bc -l <<< $absoluteValueSum/$divideBy)
includingNegativesEvaluate=$(bc -l <<< $includingNegativesSum/$divideBy)

absoluteValueOutput="${output}absolute-value.txt"
includingNegativesOutput="${output}including-negatives.txt"

echo $absoluteValueEvaluate | tr -d '\n' > $absoluteValueOutput
echo $includingNegativesEvaluate | tr -d '\n' > $includingNegativesOutput

lastLine=$( echo "$fileprep" | tail -n1 |  tr -d '-' )
firstline=$( echo "$fileprep" | head -n1 |  tr -d '-' )

firstLastOutput="${output}first-last.txt"

bc -l <<< $firstline-$lastLine | tr -d '-' | tr -d '\n' > $firstLastOutput
