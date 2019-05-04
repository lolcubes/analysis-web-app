#!/bin/bash

file=$1
length=$2

lineNumber=$(echo "$file" | wc -l)
lengthPlus=$(echo "$length - 1" | bc -l)
stoppingNumber=$(echo "$lineNumber - $lengthPlus" | bc -l)

for i in $(seq 1 $stoppingNumber); do
    section=$(echo "$file" | tail -n +${i} | head -n +${length})
    traded=$(echo "$section" | tr '\n' '+')
    echo "scale=3;(${traded}0)/${length}" | bc -l
done
