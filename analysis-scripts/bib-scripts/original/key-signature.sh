#!/bin/bash
file=$1

b=$(grep 'k\[' $file | tr '\t' '\n')

sigs=$(echo "$b" | wc -l)

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/key-signature"

for i in $(seq 1 $sigs); do
    a=$(echo "$b" | sed "${i}q;d")
    if [ "$a" == "*k[]" ]; then
        echo C-Major > "${output}/signature-${i}.txt"
        echo C-Major >> "${output}/occurrences.txt"
        echo 1 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#]" ]; then
        echo G-Major > "${output}/signature-${i}.txt"
        echo G-Major >> "${output}/occurrences.txt"
        echo 4.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#]" ]; then
        echo D-Major > "${output}/signature-${i}.txt"
        echo D-Major >> "${output}/occurrences.txt"
        echo 2 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#g#]" ]; then
        echo A-Major > "${output}/signature-${i}.txt"
        echo A-Major >> "${output}/occurrences.txt"
        echo 5.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#g#d#]" ]; then
        echo E-Major > "${output}/signature-${i}.txt"
        echo E-Major >> "${output}/occurrences.txt"
        echo 3 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#g#d#a#]" ]; then
        echo B-Major > "${output}/signature-${i}.txt"
        echo B-Major >> "${output}/occurrences.txt"
        echo 6.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#g#d#a#e#]" ]; then
        echo F\#-Major > "${output}/signature-${i}.txt"
        echo F\#-Major >> "${output}/occurrences.txt"
        echo 4 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[f#c#g#d#a#e#b#]" ]; then
        echo C\#-Major > "${output}/signature-${i}.txt"
        echo C\#-Major >> "${output}/occurrences.txt"
        echo 1.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-]" ]; then
        echo F-Major > "${output}/signature-${i}.txt"
        echo F-Major >> "${output}/occurrences.txt"
        echo 3.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-]" ]; then
        echo Bb-Major > "${output}/signature-${i}.txt"
        echo Bb-Major >> "${output}/occurrences.txt"
        echo 6 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-a-]" ]; then
        echo Eb-Major > "${output}/signature-${i}.txt"
        echo Eb-Major >> "${output}/occurrences.txt"
        echo 2.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-a-d-]" ]; then
        echo Ab-Major > "${output}/signature-${i}.txt"
        echo Ab-Major >> "${output}/occurrences.txt"
        echo 5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-a-d-g-]" ]; then
        echo Db-Major > "${output}/signature-${i}.txt"
        echo Db-Major >> "${output}/occurrences.txt"
        echo 1.5 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-a-d-g-c-]" ]; then
        echo Gb-Major > "${output}/signature-${i}.txt"
        echo Gb-Major >> "${output}/occurrences.txt"
        echo 4 >> "${output}/scale-deg-occurrences.txt"
    elif [ "$a" == "*k[b-e-a-d-g-c-f-]" ]; then
        echo Cb-Major > "${output}/signature-${i}.txt"
        echo Cb-Major >> "${output}/occurrences.txt"
        echo 0.5 >> "${output}/scale-deg-occurrences.txt"
    else
        echo "None" > "${output}/signature-${i}.txt"
    fi

done

uniq=$(cat "${output}/occurrences.txt" | sort | uniq -c | sed -e 's/^[ \t]*//' | tr ' ' '~')
lines=$(cat "${output}/occurrences.txt" | wc -l )
numbers=$(echo "$uniq" | cut -d '~' -f1)
vals=$(echo "$uniq" | cut -d '~' -f2)
percents=$(echo "$numbers" | while read line; do echo "$line/$lines" | bc -l; done )
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


