#!/bin/bash

dir=/Users/svernooy/Downloads/drive-download-20190514T211625Z-001/stanys
outdir=/Applications/MAMP/htdocs/NewTestings/Song_Database
for i in $(ls $dir); do
    for j in $(ls $dir/$i); do
        append=$(ls $outdir | wc -l)
        append=$(echo $append + 1 | bc)

        mkdir "${outdir}/${append}_${j%.*}"
        mkdir "${outdir}/${append}_${j%.*}/image-assets"
        mkdir "${outdir}/${append}_${j%.*}/data"
        mkdir "${outdir}/${append}_${j%.*}/time-info"

        echo $i | tr -d '\n' > "${outdir}/${append}_${j%.*}/time-info/composer.txt"

        cat $dir/$i/$j > "${outdir}/${append}_${j%.*}/song.txt"
        deg $dir/$i/$j > "${outdir}/${append}_${j%.*}/deg.txt"

        for h in average-note-value average-pitch average-steps key-signature most-used-note-value most-used-pitches repeated-note-value repeated-pitches scales time-signature total-time; do
            mkdir "${outdir}/${append}_${j%.*}/data/${h}"
            bash /Applications/MAMP/htdocs/NewTestings/analysis-scripts/bib-scripts/original/${h}.sh "${outdir}/${append}_${j%.*}/song.txt"
        done

        mkeyscape $dir/$i/$j > "${outdir}/${append}_${j%.*}/image-assets/keyscape.ppm"
        proll $dir/$i/$j > "${outdir}/${append}_${j%.*}/image-assets/proll.ppm"
        /usr/local/bin/convert "${outdir}/${append}_${j%.*}/image-assets/keyscape.ppm" -transparent white "${outdir}/${append}_${j%.*}/image-assets/keyscape.png"
        /usr/local/bin/convert "${outdir}/${append}_${j%.*}/image-assets/proll.ppm" -transparent black "${outdir}/${append}_${j%.*}/image-assets/proll.png"
        /Applications/MAMP/htdocs/NewTestings/analysis-scripts/other/amalgamate.sh "${outdir}/${append}_${j%.*}/song.txt"
        cat /Users/svernooy/Desktop/dataTypes.txt > "${outdir}/${append}_${j%.*}/dataTypes.txt"
        
    done
done