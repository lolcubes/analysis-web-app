#!/bin/bash
file=$1
a=$(grep 'k\[' $file)

#if $a='*k[b-]'
#then echo toaster

#else echo boi

if [ "$a" == "*k[]" ]; then
    echo C Major
elif [ "$a" == "*k[f#]" ]; then
    echo G Major
elif [ "$a" == "*k[f#c#]" ]; then
    echo D Major
elif [ "$a" == "*k[f#c#g#]" ]; then
    echo A Major
elif [ "$a" == "*k[f#c#g#d#]" ]; then
    echo E Major
elif [ "$a" == "*k[f#c#g#d#a#]" ]; then
    echo B Major
elif [ "$a" == "*k[f#c#g#d#a#e#]" ]; then
    echo F\# Major
elif [ "$a" == "*k[f#c#g#d#a#e#b#]" ]; then
    echo C\#  Major
elif [ "$a" == "*k[b-]" ]; then
    echo F Major
elif [ "$a" == "*k[b-e-]" ]; then
    echo Bb Major
elif [ "$a" == "*k[b-e-a-]" ]; then
    echo Eb Major
elif [ "$a" == "*k[b-e-a-d-]" ]; then
    echo Ab Major
elif [ "$a" == "*k[b-e-a-d-g-]" ]; then
    echo Db Major
elif [ "$a" == "*k[b-e-a-d-g-c-]" ]; then
    echo Gb Major
elif [ "$a" == "*k[b-e-a-d-g-c-f-]" ]; then
    echo Cb Major
fi