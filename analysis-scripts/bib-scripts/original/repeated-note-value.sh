# #!/bin/bash
file=$1

suffix="song.txt"

removed=$(echo $file | sed -e "s/$suffix$//")
output="${removed}data/repeated-note-value/"

threeOutput="${output}3.txt"
fourOutput="${output}4.txt"
fiveOutput="${output}5.txt"
sixOutput="${output}6.txt"
aboveOutput="${output}seven-above.txt"
largestOutput="${output}most-repetitions.txt"
timeOutput="${output}time-of-most-repetitions.txt"
valueOutput="${output}value-of-most-repeated.txt"

rhythmfile=$(grep -v '*' $file | grep -v '=' | grep -v '!' | grep -o '[[:digit:]]*' | grep '.')
test="$(echo "$rhythmfile" | uniq -c | awk '{print $2,$1}' | tr  " " "~" |  cut -d '~' -f2 | grep -v '\b1\b' | grep -v '\b2\b')"
bothcolumns="$(echo "$rhythmfile" | uniq -c | awk '{print $2,$1}' )"

three=$(echo "$test" | grep '\b3\b' | wc -l)
four=$(echo "$test" | grep '\b4\b' | wc -l)
five=$(echo "$test" | grep '\b5\b' | wc -l)
six=$(echo "$test" | grep '\b6\b' | wc -l)
above=$(echo "$test" | grep -v '\b3\b' | grep -v '\b4\b' | grep -v '\b5\b' | grep -v '\b6\b' | wc -l)
sorted="$(echo "$test" | sort -n)"
largest="${sorted##*$'\n'}"
valueoflargest="$(echo "$bothcolumns" | grep "${sorted##*$'\n'}" | tr  " " "~" |  cut -d '~' -f1 | sort -n | head -n 1 | sed 's|^|1/|')"

 
echo $three | tr -d '\n' > $threeOutput
echo $four | tr -d '\n' > $fourOutput
echo $five | tr -d '\n' > $fiveOutput
echo $six | tr -d '\n' > $sixOutput
echo $above | tr -d '\n' > $aboveOutput
echo $largest | tr -d '\n' > $largestOutput
bc -l <<< $valueoflargest*$largest | tr -d '\n' > $timeOutput
echo $valueoflargest | tr -d '\n' > $valueOutput