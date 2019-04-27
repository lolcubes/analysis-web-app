#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/time-signature"


a=$(grep '\*M' $file | grep -v 'MM' | tr '\t' '\n' | while read line; do echo $line | cut -c 3-; done)

number=$(echo "$a" | wc -l)

for i in $(seq 1 $number); do
    echo "$a" | sed "${i}q;d" > "${output}/signature-${i}.txt"
done

#if $a=