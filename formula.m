function song_correlation = formula;
  
arg_list = argv();

 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 % get all the file 1 stuff
 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 f1 = fopen ( arg_list{1}, 'r'); 
 
 x01 = fgetl(f1);
 x01 = substr(x01, 8, length(x01)-7);
 x01 = strread(x01,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x11 = fgetl(f1);
 x11 = substr(x11, 15, length(x11)-14);
 x11 = strread(x11,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x21 = fgetl(f1);
 x21 = substr(x21, 20, length(x21)-19);
 x21 = strread(x21,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x31 = fgetl(f1);
 x31 = substr(x31, 15, length(x31)-14);
 x31 = strread(x31,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x41 = fgetl(f1);
 x41 = substr(x41, 18, length(x41)-17);
 x41 = strread(x41,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x51 = fgetl(f1);
 x51 = substr(x51, 21, length(x51)-20);
 x51 = str2num(x51)';
 
 x61 = fgetl(f1);
 x61 = substr(x61, 22, length(x61)-21);
 x61 = str2num(x61)';
 
 x71 = fgetl(f1);
 x71 = substr(x71, 19, length(x71)-18);
 x71 = str2num(x71)';
 
 x81 = fgetl(f1);
 x81 = substr(x81, 16, length(x81)-16);
 x81 = strread(x81,'%f', "delimiter","/")';

 x91 = fgetl(f1);
 x91 = substr(x91, 15, length(x91)-14);
 x91 = str2num(x91)';

 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 % get all the file 2 stuff
 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%

 f2 = fopen (arg_list{2}, 'r'); 
 x02 = fgetl(f2);
 x02 = substr(x02, 8, length(x02)-7);
 x02 = strread(x02,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x12 = fgetl(f2);
 x12 = substr(x12, 15, length(x12)-14);
 x12 = strread(x12,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x22 = fgetl(f2);
 x22 = substr(x22, 20, length(x22)-19);
 x22 = strread(x22,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x32 = fgetl(f2);
 x32 = substr(x32, 15, length(x32)-14);
 x32 = strread(x32,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x42 = fgetl(f2);
 x42 = substr(x42, 18, length(x42)-17);
 x42 = strread(x42,'%f', "delimiter",";", "emptyvalue", 0)';
 
 x52 = fgetl(f2);
 x52 = substr(x52, 21, length(x52)-20);
 x52 = str2num(x52)';
 
 x62 = fgetl(f2);
 x62 = substr(x62, 22, length(x62)-21);
 x62 = str2num(x62)';
 
 x72 = fgetl(f2);
 x72 = substr(x72, 19, length(x72)-18);
 x72 = str2num(x72)';
 
 x82 = fgetl(f2);
 x82 = substr(x82, 16, length(x82)-16);
 x82 = strread(x82,'%f', "delimiter","/")';

 x92 = fgetl(f2);
 x92 = substr(x92, 15, length(x92)-14);
 x92 = str2num(x92)';
  
%%%%%%%%%%%%%%%%%%%%%%
% analysis 1: scales 
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:28
  if (max(x01(j), x02(j)) == 0) 
    y0(j) = 1;
   else 
  y0(j) = min(x01(j), x02(j))./max(x01(j), x02(j));
  endif
  endfor
yout(1) = sum(y0)/length(y0);
 
%%%%%%%%%%%%%%%%%%%%%%
% analysis 2: average pitch 
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:1
  if (max(x11(j), x12(j)) == 0) 
    y1(j) = 1;
   else 
  y1(j) = min(x11(j), x12(j))./max(x11(j), x12(j));
  endif
  endfor
yout(2) =  sum(y1)/length(y1);
 
%%%%%%%%%%%%%%%%%%%%%%
% analysis 3: average note value 
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:1
  if (max(x21(j), x22(j)) == 0) 
    y2(j) = 1;
   else 
  y2(j) = min(x21(j), x22(j))./max(x21(j), x22(j));
  endif
  endfor
yout(3) =   sum(y2)/length(y2);

%%%%%%%%%%%%%%%%%%%%%%
% analysis 4: average steps
%%%%%%%%%%%%%%%%%%%%%% 

for j = 1:3
  if (max(x31(j), x32(j)) == 0) 
    y3(j) = 1;
   else 
  y3(j) = min(x31(j), x32(j))./max(x31(j), x32(j));
  endif
  if (y3(j) < 0) 
    y3(j) = -1*y3(j);
  endif   
 endfor
yout(4) =   sum(y3)/length(y3);

%%%%%%%%%%%%%%%%%%%%%%
% analysis 5: repeated pitches
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:7
  if (max(x41(j), x42(j)) == 0) 
    y4(j) = 1;
   else 
  y4(j) = min(x41(j), x42(j))./max(x41(j), x42(j));
  endif
  endfor
 yout(5) =  sum(y4)/length(y4);

%%%%%%%%%%%%%%%%%%%%%%
% analysis 6: repeated note value
%%%%%%%%%%%%%%%%%%%%%% 
 for j = 1:6
  if (max(x51(j), x52(j)) == 0) 
    y5(j) = 1;
   else 
  y5(j) = min(x51(j), x52(j))./max(x51(j), x52(j));
  endif
  endfor
 yout(6) =  sum(y5)/length(y5);
 
%%%%%%%%%%%%%%%%%%%%%%
% analysis 7: most used note value
%%%%%%%%%%%%%%%%%%%%%% 
 if (length(x61) <= length(x62))
       a = length(x61)/2;
       b = length(x62)/2;
       
       for j = 1:a
        if (max(x61(j), x62(j)) == 0) 
          y6(j) = 1;
         else 
        y6(j) = min(x61(j), x62(j))./max(x61(j), x62(j));
        endif
      endfor

       for j = (a+1):(2*a)
        if (max(x61(j), x62(b+j-a)) == 0) 
          y6(j) = 1;
         else 
        y6(j) = min(x61(j), x62(b+j-a))./max(x61(j), x62(b+j-a));
        endif
      endfor
 else
      a = length(x62)/2;
      b = length(x61)/2;
       
       for j = 1:a
        if (max(x61(j), x62(j)) == 0) 
          y6(j) = 1;
         else 
        y6(j) = min(x61(j), x62(j))./max(x61(j), x62(j));
        endif
      endfor

       for j = (a+1):(2*a)
        if (max(x61(b+j-a), x62(j)) == 0) 
          y6(j) = 1;
         else 
        y6(j) = min(x61(b+j-a), x62(j))./max(x61(b+j-a), x62(j));
        endif
      endfor  
 endif 

yout(7) =   sum(y6)/length(y6);
%%%%%%%%%%%%%%%%%%%%%%
% analysis 8: most used pitches
%%%%%%%%%%%%%%%%%%%%%% 
if (length(x71) <= length(x72))
       a = length(x71)/2;
       b = length(x72)/2;
       for j = 1:a
        if (max(x71(j), x72(j)) == 0) 
          y7(j) = 1;
         else 
        y7(j) = min(x71(j), x72(j))./max(x71(j), x72(j));
        endif
      endfor

       for j = (a+1):(2*a)
        if (max(x71(j), x72(b+j-a)) == 0) 
          y7(j) = 1;
         else 
        y7(j) = min(x71(j), x72(b+j-a))./max(x71(j), x72(b+j-a));
        endif
      endfor
 else
      a = length (x72)/2;
      b = length (x71)/2;
      
       for j = 1:a
        if (max(x71(j), x72(j)) == 0) 
          y7(j) = 1;
         else 
        y7(j) = min(x71(j), x72(j))./max(x71(j), x72(j));
        endif
      endfor

       for j = (a+1):(2*a)
        if (max(x71(b+j-a), x72(j)) == 0) 
          y7(j) = 1;
         else 
        y7(j) = min(x71(b+j-a), x72(j))./max(x71(b+j-a), x72(j));
        endif
      endfor  
 endif 

yout(8) =   sum(y7)/length(y7);


%%%%%%%%%%%%%%%%%%%%%%
% analysis 9: time signature
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:2
  if (max(x81(j), x82(j)) == 0) 
    y8(j) = 1;
   else 
  y8(j) = min(x81(j), x82(j))./max(x81(j), x82(j));
  endif
  endfor
 yout(9) =  sum(y8)/length(y8);

%%%%%%%%%%%%%%%%%%%%%%
% analysis 10: key signature 
%%%%%%%%%%%%%%%%%%%%%% 
for j = 1:1
  if (max(x91(j), x92(j)) == 0) 
    y9(j) = 1;
   else 
  y9(j) = min(x91(j), x92(j))./max(x91(j), x92(j));
  endif
  endfor
yout(10) =   sum(y9)/length(y9);
song_correlation = sum(yout)/length(yout);
printf("%f\n ", song_correlation)
endfunction
 
