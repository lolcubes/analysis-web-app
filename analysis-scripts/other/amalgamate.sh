function amalgamate {
    suffix="song.txt"

    removed=$(echo $1 | sed -e "s/$suffix$//")
    datadir="${removed}data/"

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

}

amalgamate $1