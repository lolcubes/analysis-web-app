function addKey {
    existingKey=$(cat $1 | grep ':' | grep '*')
    
    if [ -z "$existingKey" ]; then
        columnNumber=$(grep '=' "$1" | head -n1 | awk -F"\t" '{print NF;exit}')
        for i in $(seq 1 $columnNumber); do
        clear
            echo "keySig${i}"
            cat $1 | tr '\t' '~' | cut -d '~' -f${i} | grep 'k\['
            sleep 1
        done
    else
        echo "Exiting, key signature already present..."
    fi
}

addKey /Users/svernooy/Downloads/drive-download-20190514T211625Z-001/humdrum-data-ALL/Buxtehude/Sonata_in_A_Minor__Op__1__No__3_10643.txt