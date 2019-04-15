#!/bin/bash

file=$1

sigo=$(cat $file | grep 'k\[' )

echo "<h4>Key Signature:</h4>"

if [ "$sigo" == "*k[]" ]; then
    echo C Major
elif [ "$sigo" == "*k[f#]" ]; then
    echo G Major
elif [ "$sigo" == "*k[f#c#]" ]; then
    echo D Major
elif [ "$sigo" == "*k[f#c#g#]" ]; then
    echo A Major
elif [ "$sigo" == "*k[f#c#g#d#]" ]; then
    echo  E Major
elif [ "$sigo" == "*k[f#c#g#d#a#]" ]; then
    echo  B Major
elif [ "$sigo" == "*k[f#c#g#d#a#e#]" ]; then
    echo  F\# Major
elif [ "$sigo" == "*k[f#c#g#d#a#e#b#]" ]; then
    echo  C\#  Major
elif [ "$sigo" == "*k[b-]" ]; then
    echo  F Major
elif [ "$sigo" == "*k[b-e-]" ]; then
    echo  Bb Major
elif [ "$sigo" == "*k[b-e-a-]" ]; then
    echo  Eb Major
elif [ "$sigo" == "*k[b-e-a-d-]" ]; then
    echo  Ab Major
elif [ "$sigo" == "*k[b-e-a-d-g-]" ]; then
    echo  Db Major
elif [ "$sigo" == "*k[b-e-a-d-g-c-]" ]; then
    echo  Gb Major
elif [ "$sigo" == "*k[b-e-a-d-g-c-f-]" ]; then
    echo  Cb Major
fi