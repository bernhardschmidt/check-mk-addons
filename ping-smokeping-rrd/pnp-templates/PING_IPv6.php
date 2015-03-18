<?php
# Copyright (c) 2015 Alexander Wilke <Wilke@iabg.de>
#               2015 Bernhard Schmidt <Bernhard.Schmidt@lrz.de>
# 
# inspired by Smokeping from Tobias Oetiker <tobi@oetiker.ch>
# http://people.ee.ethz.ch/~oetiker/webtools/smokeping/
# 
# This file is free software; you can redistribute it and/or
# modify it under the terms of the GNU Lesser General Public
# License as published by the Free Software Foundation; either
# version 3.0 of the License, or (at your option) any later version.
# 
# This file is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# Lesser General Public License for more details.

$ds_name[1] = "Round Trip Averages";
$opt[1] = "--vertical-label \"RTA (ms)\" --title \"Ping times for $hostname\" ";
$def[1] =  "DEF:rtavg=$RRDFILE[1]:$DS[1]:AVERAGE " ;
$def[1] .= "DEF:loss=$RRDFILE[2]:$DS[2]:MAX " ;
# no rtmin/rtmax for check_ping6
# $def[1] .= "DEF:rtmax=$RRDFILE[3]:$DS[3]:MAX " ;
# $def[1] .= "DEF:rtmin=$RRDFILE[4]:$DS[4]:MIN " ;

$def[1] .= "CDEF:loss0=loss,1,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss10=loss,10,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss20=loss,20,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss30=loss,30,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss40=loss,40,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss50=loss,50,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss80=loss,80,LT,rtavg,UNKN,IF " ;
$def[1] .= "CDEF:loss100=loss,80,GE,rtavg,UNKN,IF " ;

# Draw red background at 100% loss
$def[1] .= "CDEF:lossbg100=loss,100,EQ,INF,UNKN,IF " ;
$def[1] .= "AREA:lossbg100#FFCCCC " ;

# $def[1] .= "CDEF:dif=rtmax,rtmin,- " ;

# $def[1] .= "LINE:rtmin " ;
# $def[1] .= "AREA:dif#EEE::STACK " ;
# $def[1] .= "LINE1:rtmin#bbb " ;
# $def[1] .= "LINE1:rtmax#bbb " ;

$def[1] .= "LINE2:loss100#FF0000:\">= 80% \" " ;
$def[1] .= "LINE2:loss80#FFC000:\"< 80% \" " ;
$def[1] .= "LINE2:loss40#F000F0:\"< 40% \" " ;
$def[1] .= "LINE2:loss30#8C00FF:\"< 30% \" " ;
$def[1] .= "LINE2:loss20#2020FF:\"< 20% \" " ;
$def[1] .= "LINE2:loss10#00C0FF:\"< 10% \" " ;
$def[1] .= "LINE2:loss0#00F000:\"0% \\n\" " ;


$def[1] .= "COMMENT:\"RTT\: \" " ;
$def[1] .= "GPRINT:rtavg:LAST:\"%6.2lf $UNIT[1] last \" " ;
# $def[1] .= "GPRINT:rtmax:MAX:\"%6.2lf $UNIT[1] max \" " ;
# $def[1] .= "GPRINT:rtmin:MIN:\"%6.2lf $UNIT[1] min \" " ;
$def[1] .= "GPRINT:rtavg:AVERAGE:\"%6.2lf $UNIT[1] avg \\n\" " ;
$def[1] .= "COMMENT:\"Loss\: \" " ;
$def[1] .= "GPRINT:loss:MAX:\"%3.0lf $UNIT[2] max \" " ;
$def[1] .= "GPRINT:loss:AVERAGE:\"%3.0lf $UNIT[2] avg \\n\" " ;

?>

