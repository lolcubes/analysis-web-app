# #!/bin/bash

count() {
    tailnumber=$(( $3 - $2 + 1 ))
    pattern=$(echo  "$1" | head -n $3 | tail -n $tailnumber)
    echo "$1" | pcregrep -Mc "^\Q$(echo "$pattern")\E$"
}


file=$1
fileprep=$(grep -v '=' $file | grep -v '!' | grep -v '*' |  grep -o '[[:digit:]]*' | grep . )

linecount=$(echo "$fileprep" | wc -l)
start=1


for i in {2..45}; do
    len=$i
    end=$(( $linecount - $len + 1 ))

    test=
    for j in $(seq $start $end); do
        test="$test\n$(count "$fileprep" $j $((j+len-1)))"
    done


    a=$(printf $test | grep -v '\b1\b' )
    totalrepetitions=$(echo "$a" | wc -l)
    mostrepetitions=$(echo "$a" | sort -rn | head -n1)
    mostrepetitions=$(echo "$a" | sort -rn | head -n1)

    var2=
    for k in $(seq 1 $mostrepetitions); do
        var1=$(printf "$a" | grep '\b'$k'\b' | wc -l)
        var2="$var2\n$(echo $(( var1 / k )))"
    done
    printf "$var2" | tr '\n' '+' | awk '{print "0"$0}' | bc -l
    echo $mostrepetitions
    echo $totalrepetitions
done
