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
        echo C Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#]" ]; then
        echo G Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#]" ]; then
        echo D Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#g#]" ]; then
        echo A Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#g#d#]" ]; then
        echo E Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#g#d#a#]" ]; then
        echo B Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#g#d#a#e#]" ]; then
        echo F\# Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[f#c#g#d#a#e#b#]" ]; then
        echo C\#  Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-]" ]; then
        echo F Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-]" ]; then
        echo Bb Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-a-]" ]; then
        echo Eb Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-a-d-]" ]; then
        echo Ab Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-a-d-g-]" ]; then
        echo Db Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-a-d-g-c-]" ]; then
        echo Gb Major > "${output}/signature-${i}.txt"
    elif [ "$a" == "*k[b-e-a-d-g-c-f-]" ]; then
        echo Cb Major > "${output}/signature-${i}.txt"
    else
        echo "No key signature found." > "${output}/signature-${i}.txt"
    fi
done