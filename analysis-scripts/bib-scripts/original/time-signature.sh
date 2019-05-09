#!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/time-signature"


sigs=$(grep '\*M' $file | grep -v 'MM' | tr '\t' '\n' | while read line; do echo $line | cut -c 3-; done)

number=$(echo "$sigs" | wc -l)

for i in $(seq 1 $number); do
    echo "$sigs" | sed "${i}q;d" > "${output}/signature-${i}.txt"
    echo "$sigs" | sed "${i}q;d" >> "${output}/occurrences.txt"
done

uniq=$(cat "${output}/occurrences.txt" | sort | uniq -c | sed -e 's/^[ \t]*//' | tr ' ' '~')
lines=$(cat "${output}/occurrences.txt" | wc -l )
numbers=$(echo "$uniq" | cut -d '~' -f1)
vals=$(echo "$uniq" | cut -d '~' -f2)
percents=$(echo "$numbers" | while read line; do echo "scale=2;(${line}/${lines})*100" | bc -l; done )
seqVal=$(echo "$percents" | wc -l)

seqValMinus=$(echo "$seqVal - 1" | bc -l)

if [ $seqValMinus -lt "1" ]; then

    echo "$percents" | tr -d '\n' >> "${output}/occurrences-percents.txt"
    echo "$vals" | tr -d '\n' >> "${output}/occurrences-values.txt"

elif [ $seqValMinus -ge "1" ]; then

    for x in $(seq 1 $seqValMinus); do
        echo "$percents" | sed "${x}q;d" | tr -d '\n' | sed 's/$/,/' | tr -d '\n' >> "${output}/occurrences-percents.txt"
    done
    echo "$percents" | sed "${seqVal}q;d" | tr -d '\n' >> "${output}/occurrences-percents.txt"
    for x in $(seq 1 $seqValMinus); do
        echo "$vals" | sed "${x}q;d" | tr -d '\n' | sed 's/$/,/' | tr -d '\n' >> "${output}/occurrences-values.txt"
    done
    echo "$vals" | sed "${seqVal}q;d" | tr -d '\n' >> "${output}/occurrences-values.txt"

fi
