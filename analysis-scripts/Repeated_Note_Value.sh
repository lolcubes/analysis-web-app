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
beats=$(bc -l <<< $valueoflargest*$largest)
echo "<h4>Repeated Note Value:</h4>"
echo Amount of Repeated Note Value Sequences of Length 3: $three
echo Amount of Repeated Note Value Sequences of Length 4: $four
echo Amount of Repeated Note Value Sequences of Length 5: $five
echo Amount of Repeated Note Value Sequences of Length 6: $six
echo Amount of Repeated Note Value Sequences of Length 7 or More: $above
echo Longest of Such Sequences \(In Notes\): $largest
echo Longest of Such Sequences \(In Beats\): $beats
echo Most Repeated Note Value: $valueoflargest