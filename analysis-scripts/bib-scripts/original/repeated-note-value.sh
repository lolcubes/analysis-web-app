# #!/bin/bash
file=$1
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

 
echo $three
echo $four
echo $five
echo $six
echo $above
echo $largest
bc -l <<< $valueoflargest*$largest
echo $valueoflargest