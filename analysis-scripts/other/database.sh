#!/bin/bash

dir=/Users/svernooy/Downloads/drive-download-20190514T211625Z-001/stanys
outdir=/Applications/MAMP/htdocs/NewTestings/Song_Database
for i in $(ls $dir); do
    for j in $(ls $dir/$i); do
        append=$(ls $outdir | wc -l)
        append=$(echo $append + 1 | bc)
        mkdir "${outdir}/${append}_${j%.*}"
        mkdir "${outdir}/${append}_${j%.*}/image-assets"
        cat $dir/$i/$j > "${outdir}/${append}_${j%.*}/song.txt"
        deg $dir/$i/$j > "${outdir}/${append}_${j%.*}/deg.txt"
        hum2mid $dir/$i/$j -o "${outdir}/${append}_${j%.*}/song.mid"
        mkeyscape $dir/$i/$j > "${outdir}/${append}_${j%.*}/image-assets/keyscape.ppm"
        proll $dir/$i/$j > "${outdir}/${append}_${j%.*}/image-assets/proll.ppm"
    done
done