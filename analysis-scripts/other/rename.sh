#!/bin/bash
for x in $(ls /Users/svernooy/Downloads/drive-download-20190514T211625Z-001/humdrum-data-ALL); do
    directory="/Users/svernooy/Downloads/drive-download-20190514T211625Z-001/humdrum-data-ALL/${x}"
    printf "\n"
    echo "starting $x"
    echo "==============="
    printf "\n"
    for i in $(ls $directory); do

        name=$(export LC_ALL=C; grep 'OTL' "${directory}/${i}" | grep -v '!!muse2ps:' | grep -v '!!!ref:' | grep ':' | cut -d '!' -f4 | cut -d '@' -f3 | sed s/OTL://)
        namecount=$(echo "$name" | wc -l)
        # echo $i

        if [ $namecount -gt 1 ]; then
            echo "too many"
            mv "${directory}/${i}" "${directory}/UNAMED_${i}.txt" 
        else
            if [ -z "$name" ]; then
                echo 'empty'
                mv "${directory}/${i}" "${directory}/UNAMED_${i}.txt" 
            else
                name=$(export LC_ALL=C; echo $name | tr ',' '_' | tr "'" "_" | tr ' ' '_' | tr '.' '_' | tr '-' '_' | tr '&' '_' | tr ';' '_' | tr ':' '_' | tr -d '%' )
                
                if [ -f "${directory}/${name}.txt" ]; then
                    randint=$(echo $((10000 + RANDOM % 9999)))
                    mv "${directory}/${i}" "${directory}/${name}_${randint}.txt"
                else 
                    mv "${directory}/${i}" "${directory}/${name}.txt"
                fi


            fi
        fi
    done
    clear
done