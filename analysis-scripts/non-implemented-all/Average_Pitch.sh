#!/bin/bash
file=$1
summedpitches="$(deg $file | grep -v '=' | grep -v '*' | grep -v '!' | tr "\t" "~" | cut -d'~' -f1 | grep -v 'r' | tr -d ^ | tr -d v | tr -d . | sed '/^$/d' | sed 's/+/.5/g' | sed 's/1-/0.5/g' | sed 's/2-/1.5/g' | sed 's/3-/2.5/g' | sed 's/4-/3.5/g' | sed 's/5-/4.5/g' | sed 's/6-/5.5/g' | sed 's/7-/6.5/g' | tr '\n' '+' | awk '{print $0"0"}' | bc -l)"
totallines="$(deg $file | grep -v '=' | grep -v '*' | grep -v '!' | tr "\t" "~" | cut -d'~' -f1 | grep -v 'r' | wc -l)"

bc -l <<< $summedpitches/$totallines

#echo $fileprep