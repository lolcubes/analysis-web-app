#!/bin/bash

file=$1

a=$(grep -v ‘=’ $file | grep -v ‘*’ | grep -v ‘!!’ | grep -v 'r' | grep '16' | grep -v '16\.' | wc -l) # isolate note, find count
c=$(bc -l <<< $a*'1/16') # multiply by note value
b=$(grep -v '=' $file | grep -v '!!' | grep -v '*' | grep -o '[[:digit:]]*' | grep . | sed 's|^|1/|' | tr '\n' '+' | awk '{print $0"0"}' | bc -l)  

bc -l <<< $c/$b