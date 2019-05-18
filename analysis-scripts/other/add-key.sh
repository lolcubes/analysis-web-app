function addKey {
    existingKey=$(cat $1 | grep ':' | grep '*' | grep -v '!')
    
    if [ -z "$existingKey" ]; then
       keysigs=$(grep 'k\[' $1 | tr '\t' '\n')
       number=$(echo "$keysigs" | wc -l)
       linenumber=$(grep 'k\[' -n -m 1 $1 | cut -d ':' -f1)
       linenumberMinus=$(echo $linenumber-1 | bc -l)

        keyInterpretation=
        for i in $(seq 1 $number); do

            keySig=$(echo "$keysigs" | sed "${i}q;d")

            if [ "$keySig" == "*k[]" ]; then
                keyInterpretation="$keyInterpretation\n*C:"
            elif [ "$keySig" == "*k[f#]" ]; then
                keyInterpretation="$keyInterpretation\n*G:"
            elif [ "$keySig" == "*k[f#c#]" ]; then
                keyInterpretation="$keyInterpretation\n*D:" 
            elif [ "$keySig" == "*k[f#c#g#]" ]; then
                keyInterpretation="$keyInterpretation\n*A:"
            elif [ "$keySig" == "*k[f#c#g#d#]" ]; then
                keyInterpretation="$keyInterpretation\n*E:"
            elif [ "$keySig" == "*k[f#c#g#d#a#]" ]; then
                keyInterpretation="$keyInterpretation\n*B:"
            elif [ "$keySig" == "*k[f#c#g#d#a#e#]" ]; then
                keyInterpretation="$keyInterpretation\n*F\#:"
            elif [ "$keySig" == "*k[f#c#g#d#a#e#b#]" ]; then
                keyInterpretation="$keyInterpretation\n*C\#:"
            elif [ "$keySig" == "*k[b-]" ]; then
                keyInterpretation="$keyInterpretation\n*F:"
            elif [ "$keySig" == "*k[b-e-]" ]; then
                keyInterpretation="$keyInterpretation\n*B-:"
            elif [ "$keySig" == "*k[b-e-a-]" ]; then
                keyInterpretation="$keyInterpretation\n*E-:"
            elif [ "$keySig" == "*k[b-e-a-d-]" ]; then
                keyInterpretation="$keyInterpretation\n*A-:"
            elif [ "$keySig" == "*k[b-e-a-d-g-]" ]; then
                keyInterpretation="$keyInterpretation\n*D-:"
            elif [ "$keySig" == "*k[b-e-a-d-g-c-]" ]; then
                keyInterpretation="$keyInterpretation\n*G-:"
            else [ "$keySig" == "*k[b-e-a-d-g-c-f-]" ];
                keyInterpretation="$keyInterpretation\n*C-:"
            fi

        done

        interpretationList=$(printf $keyInterpretation | grep .  | tr '\n' '\t')

        lines=$(cat $1 | wc -l)
        tailNumber=$(echo $lines-$linenumber | bc -l)


        first=$(cat $1 | head -n${linenumber})
        second=$(echo "$interpretationList")
        third=$(cat $1 | tail -n${tailNumber})
        echo "$first" > $1
        echo "$second" >> $1
        echo "$third" >> $1

    else
        echo 'exists, quitting...'
    fi
}

addKey $1


