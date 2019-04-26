#!/bin/bash
file=$1
fileprep=$(deg $file | grep '.' | grep -v '!' | grep -v '*' | grep -v '=' | grep -o '[[:digit:]]*' | grep '.' | perl -lne 'if ($.==1){$p=$_} else{print "$p ".($_-$p); $p=$_} END{print $p}' | tr ' ' '~' | cut -d '~' -f2)
divideBy=$( echo "$fileprep" | wc -l)
includingNegativesSum=$( echo "$fileprep" | tr '\n' '+' | awk '{print $0"0"}' | bc -l)
absoluteValueSum=$( echo "$fileprep" | tr -d '-'  | tr '\n' '+' | awk '{print $0"0"}' | bc -l)
absoluteValueEvaluate=$(bc -l <<< $absoluteValueSum/$divideBy)
includingNegativesEvaluate=$(bc -l <<< $includingNegativesSum/$divideBy)

echo $absoluteValueEvaluate
echo $includingNegativesEvaluate

lastLine=$( echo "$fileprep" | tail -n1 |  tr -d '-' )
firstline=$( echo "$fileprep" | head -n1 |  tr -d '-' )

bc -l <<< $firstline-$lastLine | tr -d '-' 
