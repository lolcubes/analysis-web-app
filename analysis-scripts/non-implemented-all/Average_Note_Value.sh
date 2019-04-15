#!/bin/bash

sumfile=/tmp/humdrumsum
file=$1

if [ -f $sumfile ]; then
    echo "Sumfile exists; instance of script may already be running; exiting..."
    exit 1
fi

a=$(grep -v '=' $file | grep -o '[[:digit:]]*' | grep .)
b=$(grep -v '=' $file | grep -o '[[:digit:]]*' | grep . | wc -l)

sum=0
grep -v '=' $file | grep -o '[[:digit:]]*' | grep . | while read line
do
    sum=$(($sum+$line))
    echo $sum > $sumfile
done

a=$(cat $sumfile) && rm $sumfile

c=$(bc -l <<< $a/$b)
echo 1/$c 
#bc -l <<< 1/$c