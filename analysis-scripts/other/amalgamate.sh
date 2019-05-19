function averageTimeSigs {
    file=$1
    lineNumber=$(echo "$file" | wc -l)
    topNums=$(echo "$file" | cut -d '/' -f1)
    bottomNums=$(echo "$file" | cut -d '/' -f2)
    topSum=$(echo "$topNums" | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    bottomSum=$(echo "$bottomNums" | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    echo "time-signature:$(echo "scale=2;$topSum/$lineNumber" | bc -l)/$(echo "scale=2;$bottomSum/$lineNumber" | bc -l);"
}

function averageKeySigs {
    number=$(echo "$1" | wc -l)
    sum=$(echo "$1" | tr '\n' '+' | rev | cut -c 2- | rev | bc)
    div=$(echo "scale=2; ${sum}/${number}" | bc -l)
    snapped=$(echo $div | cut -d '.' -f1)
    decim=$(echo $div | cut -d '.' -f2)
    if [ $decim -ge "75" ]; then
        snapped=$(echo "$snapped+1" | bc )
    fi

    if [ $decim -ge "25" ]; then
        if [ $decim -lt "75" ]; then
            snapped=$(echo "$snapped+0.5" | bc )
        fi
    fi
    

    echo "key-signature:$snapped;"
        
}

function amalgamate {
    suffix="song.txt"

    removed=$(echo $1 | sed -e "s/$suffix$//")
    datadir="${removed}data/"
    output="${datadir}amalgamated.txt"

    #============================================
    #scales
    #=============================================

        #ascSingle:
        #=============================================
            ascSing2=$(cat ${datadir}scales/ascending-single/2.txt)
            ascSing3=$(cat ${datadir}scales/ascending-single/3.txt)
            ascSing4=$(cat ${datadir}scales/ascending-single/4.txt)
            ascSing5=$(cat ${datadir}scales/ascending-single/5.txt)
            ascSing6=$(cat ${datadir}scales/ascending-single/6.txt)
            ascSing7=$(cat ${datadir}scales/ascending-single/seven-above.txt)
            ascSingLargest=$(cat ${datadir}scales/ascending-single/largest.txt)

        #ascdouble:
        #=============================================
            ascDoub2=$(cat ${datadir}scales/ascending-double/2.txt)
            ascDoub3=$(cat ${datadir}scales/ascending-double/3.txt)
            ascDoub4=$(cat ${datadir}scales/ascending-double/4.txt)
            ascDoub5=$(cat ${datadir}scales/ascending-double/5.txt)
            ascDoub6=$(cat ${datadir}scales/ascending-double/6.txt)
            ascDoub7=$(cat ${datadir}scales/ascending-double/seven-above.txt)
            ascDoubLargest=$(cat ${datadir}scales/ascending-double/largest.txt)

        #descSing:
        #=============================================
            descSing2=$(cat ${datadir}scales/descending-single/2.txt)
            descSing3=$(cat ${datadir}scales/descending-single/3.txt)
            descSing4=$(cat ${datadir}scales/descending-single/4.txt)
            descSing5=$(cat ${datadir}scales/descending-single/5.txt)
            descSing6=$(cat ${datadir}scales/descending-single/6.txt)
            descSing7=$(cat ${datadir}scales/descending-single/seven-above.txt)
            descSingLargest=$(cat ${datadir}scales/descending-single/largest.txt)
        
        #descDoub:
        #=============================================
            descDoub2=$(cat ${datadir}scales/descending-double/2.txt)
            descDoub3=$(cat ${datadir}scales/descending-double/3.txt)
            descDoub4=$(cat ${datadir}scales/descending-double/4.txt)
            descDoub5=$(cat ${datadir}scales/descending-double/5.txt)
            descDoub6=$(cat ${datadir}scales/descending-double/6.txt)
            descDoub7=$(cat ${datadir}scales/descending-double/seven-above.txt)
            descDoubLargest=$(cat ${datadir}scales/descending-double/largest.txt)
            printf "scales:${ascSing2};${ascSing3};${ascSing4};${ascSing5};${ascSing6};${ascSing7};${ascSingLargest};${ascDoub2};${ascDoub3};${ascDoub4};${ascDoub5};${ascDoub6};${ascDoub7};${ascDoubLargest};${descSing2};${descSing3};${descSing4};${descSing5};${descSing6};${descSing7};${descSingLargest};${descDoub2};${descDoub3};${descDoub4};${descDoub5};${descDoub6};${descDoub7};${descDoubLargest};\n" > $output
    
    #average Pitch
    #=====================================
        avPitch=$(cat ${datadir}average-pitch/pitch.txt)
        printf "average-pitch:$avPitch;\n" >> $output

    #average Note Value
    #=====================================
        avValue=$(cat ${datadir}average-note-value/value.txt)
        printf "average-note-value:$avValue;\n" >> $output
    #average Steps
    #=====================================
        absVal=$(cat ${datadir}average-steps/absolute-value.txt)
        negs=$(cat ${datadir}average-steps/including-negatives.txt)
        firstLast=$(cat ${datadir}average-steps/first-last.txt)
        printf "average-steps:$absVal;$negs;$firstLast;\n" >> $output

    #repeated Pitches 
    #=====================================
        two=$(cat ${datadir}repeated-pitches/2.txt)
        three=$(cat ${datadir}repeated-pitches/3.txt)
        four=$(cat ${datadir}repeated-pitches/4.txt)
        five=$(cat ${datadir}repeated-pitches/5.txt)
        six=$(cat ${datadir}repeated-pitches/6.txt)
        seven=$(cat ${datadir}repeated-pitches/seven-above.txt)
        mostreps=$(cat ${datadir}repeated-pitches/most-repetitions.txt)
        printf "repeated-pitches:$two;$three;$four;$five;$six;$seven;$mostreps;\n" >> $output

    #repeated note-value 
    #=====================================
        three=$(cat ${datadir}repeated-note-value/3.txt)
        four=$(cat ${datadir}repeated-note-value/4.txt)
        five=$(cat ${datadir}repeated-note-value/5.txt)
        six=$(cat ${datadir}repeated-note-value/6.txt)
        seven=$(cat ${datadir}repeated-note-value/seven-above.txt)
        mostreps=$(cat ${datadir}repeated-note-value/most-repetitions.txt)
        time=$(cat ${datadir}repeated-note-value/time-of-most-repetitions.txt)
        value=$(cat ${datadir}repeated-note-value/value-of-most-repeated.txt)

        printf "repeated-note-value:$three;$four;$five;$six;$seven;$mostreps;$time;$value;\n" >> $output

    #most-used-note-value
    #=====================================
        one=$(cat ${datadir}most-used-note-value/1.txt)
        two=$(cat ${datadir}most-used-note-value/2.txt)
        three=$(cat ${datadir}most-used-note-value/3.txt)
        four=$(cat ${datadir}most-used-note-value/4.txt)
        five=$(cat ${datadir}most-used-note-value/5.txt)

        perone=$(cat ${datadir}most-used-note-value/Percent_1.txt)
        pertwo=$(cat ${datadir}most-used-note-value/Percent_2.txt)
        perthree=$(cat ${datadir}most-used-note-value/Percent_3.txt)
        perfour=$(cat ${datadir}most-used-note-value/Percent_4.txt)
        perfive=$(cat ${datadir}most-used-note-value/Percent_5.txt)

        printf "most-used-note-value:$one;$two;$three;$four;$five;$perone;$pertwo;$perthree;$perfour;$perfive;\n" >> $output
   
    #most-used-pitch
    #========================================
        one=$(cat ${datadir}most-used-pitches/1.txt | cut -d ' ' -f1 | sed s/+/.5/ | sed s/-/-0.5/ | bc)
        two=$(cat ${datadir}most-used-pitches/2.txt | cut -d ' ' -f1 | sed s/+/.5/ | sed s/-/-0.5/ | bc)
        three=$(cat ${datadir}most-used-pitches/3.txt | cut -d ' ' -f1 | sed s/+/.5/ | sed s/-/-0.5/ | bc)
        four=$(cat ${datadir}most-used-pitches/4.txt | cut -d ' ' -f1 | sed s/+/.5/ | sed s/-/-0.5/ | bc)
        five=$(cat ${datadir}most-used-pitches/5.txt | cut -d ' ' -f1 | sed s/+/.5/ | sed s/-/-0.5/ | bc)

        perone=$(cat ${datadir}most-used-pitches/Percent_1.txt)
        pertwo=$(cat ${datadir}most-used-pitches/Percent_2.txt)
        perthree=$(cat ${datadir}most-used-pitches/Percent_3.txt)
        perfour=$(cat ${datadir}most-used-pitches/Percent_4.txt)
        perfive=$(cat ${datadir}most-used-pitches/Percent_5.txt)

        printf "most-used-pitches:$one;$two;$three;$four;$five;$perone;$pertwo;$perthree;$perfour;$perfive;\n" >> $output
   


    #timeSig
    #=====================================
    occurrences=$(cat ${datadir}time-signature/occurrences.txt)
    averageTimeSigs "$occurrences" >> $output

    #KeySig
    #=====================================
    occurrences=$(cat ${datadir}key-signature/scale-deg-occurrences.txt)
    averageKeySigs "$occurrences" >> $output
}

amalgamate $1
