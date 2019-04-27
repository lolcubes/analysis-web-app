#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/repeated-pitches/"

twoOutput="${output}2.txt"
threeOutput="${output}3.txt"
fourOutput="${output}4.txt"
fiveOutput="${output}5.txt"
sixOutput="${output}6.txt"
aboveOutput="${output}seven-above.txt"
largestOutput="${output}most-repetitions.txt"

fileprep=$(/Applications/MAMP/htdocs/NewTestings/analysis-scripts/humdrum/deg/deg $file | grep -v '*' | grep -v '=' | grep -v '!' | grep -v 'r' | grep -v '\.' | tr '\t' '\n' | grep . | sed 's/[\^v]//g' | uniq -c | awk '{print $2,$1}' | tr ' ' '~' | cut -d '~' -f2)

two=$(echo "$fileprep" | grep '\b2\b' | wc -l)
three=$(echo "$fileprep" | grep '\b3\b' | wc -l)
four=$(echo "$fileprep" | grep '\b4\b' | wc -l)
five=$(echo "$fileprep" | grep '\b5\b' | wc -l)
six=$(echo "$fileprep" | grep '\b6\b' | wc -l)
above=$(echo "$fileprep" | grep -v '\b1\b' | grep -v '\b2\b' | grep -v '\b4\b' | grep -v '\b5\b' | grep -v '\b6\b' | wc -l)
largest="$(echo "$fileprep" | sort -n -r | head -n 1)"
test=1
if [ "$above" -eq "0" ]; then
    boi="0"
else
    boi=`expr $above - $test`
fi

echo $two > $twoOutput
echo $three > $threeOutput
echo $four > $fourOutput
echo $five > $fiveOutput
echo $six > $sixOutput
echo $boi > $aboveOutput
echo $largest > $largestOutput
