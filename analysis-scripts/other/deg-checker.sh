#!/bin/bash

function checkDeg {
    file=$1
    lineNumber=$(cat $file | wc -l)
    degNumber=$(deg $file | wc -l)

    if [ "$lineNumber" -eq "$degNumber" ]; then
        echo "Deg successful"
    else
        echo "Failed, deleting file"
        trash $1
    fi
}

for i in $(ls /Users/svernooy/Downloads/drive-download-20190514T211625Z-001/humdrum-data-ALL); do
    for j in $(ls /Users/svernooy/Downloads/drive-download-20190514T211625Z-001/humdrum-data-ALL/$i); do
        echo $j
    done
done