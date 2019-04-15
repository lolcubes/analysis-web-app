#!/bin/bash
file=$1
fileprep=$(deg $file | grep -v '*' | grep -v '=' | grep -v '!' | grep -v 'r' | grep -v '\.' | tr '\t' '~' | cut -d '~' -f1 | sed 's/[\^v]//g' | uniq -c | awk '{print $2,$1}' | tr ' ' '~' | cut -d '~' -f2)

two=$(echo "$fileprep" | grep '\b2\b' | wc -l)
three=$(echo "$fileprep" | grep '\b3\b' | wc -l)
four=$(echo "$fileprep" | grep '\b4\b' | wc -l)
five=$(echo "$fileprep" | grep '\b5\b' | wc -l)
six=$(echo "$fileprep" | grep '\b6\b' | wc -l)
above=$(echo "$fileprep" | grep -v '\b1\b' | grep -v '\b2\b' | grep -v '\b4\b' | grep -v '\b5\b' | grep -v '\b6\b' | wc -l)
sorted="$(echo "$fileprep" | sort -n)"
test=1
boi=`expr $above - $test`
largest="${sorted##*$'\n'}"
echo $two
echo $three
echo $four
echo $five
echo $six
echo $boi
echo $largest
# uniq -c