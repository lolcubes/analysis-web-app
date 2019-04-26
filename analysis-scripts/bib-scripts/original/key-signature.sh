#!/bin/bash
file=$1

a=$(grep 'k\[' $file)

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/key-signature/key-signature.txt"

if [ "$a" == "*k[]" ]; then
    echo C Major > $output
elif [ "$a" == "*k[f#]" ]; then
    echo G Major > $output
elif [ "$a" == "*k[f#c#]" ]; then
    echo D Major > $output
elif [ "$a" == "*k[f#c#g#]" ]; then
    echo A Major > $output
elif [ "$a" == "*k[f#c#g#d#]" ]; then
    echo E Major > $output
elif [ "$a" == "*k[f#c#g#d#a#]" ]; then
    echo B Major > $output
elif [ "$a" == "*k[f#c#g#d#a#e#]" ]; then
    echo F\# Major > $output
elif [ "$a" == "*k[f#c#g#d#a#e#b#]" ]; then
    echo C\#  Major > $output
elif [ "$a" == "*k[b-]" ]; then
    echo F Major > $output
elif [ "$a" == "*k[b-e-]" ]; then
    echo Bb Major > $output
elif [ "$a" == "*k[b-e-a-]" ]; then
    echo Eb Major > $output
elif [ "$a" == "*k[b-e-a-d-]" ]; then
    echo Ab Major > $output
elif [ "$a" == "*k[b-e-a-d-g-]" ]; then
    echo Db Major > $output
elif [ "$a" == "*k[b-e-a-d-g-c-]" ]; then
    echo Gb Major > $output
elif [ "$a" == "*k[b-e-a-d-g-c-f-]" ]; then
    echo Cb Major > $output
else
    echo "No key signature found." > $output
fi
