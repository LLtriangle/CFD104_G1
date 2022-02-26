function createCalendar(){



    var mesos = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];
    var dies_abr = [
        '日',
        '一',
        '二',
        '三',
        '四',
        '五',
        '六'
    ];
    
    Number.prototype.pad = function(num) {
        var str = '';
        for(var i = 0; i < (num-this.toString().length); i++)
            str += '0';
        return str += this.toString();
    }
    
    function calendari(widget, data)
    {
        
        var original = widget.getElementsByClassName('actiu')[0];
        
        if(typeof original === 'undefined')
        {
            original = document.createElement('table');
            original.setAttribute('data-actual',
                      data.getFullYear() + '/' +
                      data.getMonth().pad(2) + '/' +
                      data.getDate().pad(2))
            widget.appendChild(original);
        }
    
        var diff = data - new Date(original.getAttribute('data-actual'));
    
        diff = new Date(diff).getMonth();
    
        var e = document.createElement('table');
    
        e.className = diff  === 0 ? 'next_m' : 'last_m';
        e.innerHTML = '';
    
        widget.appendChild(e);
    
        e.setAttribute('data-actual',
                       data.getFullYear() + '/' +
                       data.getMonth().pad(2) + '/' +
                       data.getDate().pad(2))
    
        var fila = document.createElement('tr');
        var title = document.createElement('th');
        title.setAttribute('colspan', 7);
    
        var boto_prev = document.createElement('button');
        //左按鈕className
        boto_prev.className = 'boto-prev';
        //左按鈕圖案
        boto_prev.innerHTML = '◀';
        boto_prev.type = "button";
    
        var boto_next = document.createElement('button');
        //右按鈕className
        boto_next.className = 'boto-next';
        //右按鈕圖案
        boto_next.innerHTML = '▶';
        boto_next.type = "button";
    
        title.appendChild(boto_prev);
        title.appendChild(document.createElement('span')).innerHTML = 
            mesos[data.getMonth()] + '<span class="any">' + data.getFullYear() + '</span>';
    
        title.appendChild(boto_next);
    
        boto_prev.onclick = function() {
            data.setMonth(data.getMonth() - 1);
            calendari(widget, data);
        };
    
        boto_next.onclick = function() {
            data.setMonth(data.getMonth() + 1);
            calendari(widget, data);
        };
    
        fila.appendChild(title);
        e.appendChild(fila);
    
        fila = document.createElement('tr');
    
        for(var i = 1; i < 7; i++)
        {
            fila.innerHTML += '<th>' + dies_abr[i] + '</th>';
        }
    
        fila.innerHTML += '<th>' + dies_abr[0] + '</th>';
        e.appendChild(fila);
    
        /* Obtinc el dia que va acabar el mes anterior */
        var inici_mes =
            new Date(data.getFullYear(), data.getMonth(), -1).getDay();
    
        var actual = new Date(data.getFullYear(),
                  data.getMonth(),
                  -inici_mes);
    
        // console.log(inici_mes);
        // console.log(actual);
    
        // 生6列
        for(var s = 0; s < 6; s++){
            var fila = document.createElement('tr');
    
            // 生7行(禮拜一到日)
            for(var d = 1; d < 8; d++){
                // 生成td欄位、span放日期、div放時間段
                var td = document.createElement('td');
                var div_flex = document.createElement('div');
                var div_date = document.createElement('div');
                var span = document.createElement('span');
                var div = document.createElement('div');
                var morning = document.createElement('span');
                var afternoon = document.createElement('span');
                var night = document.createElement('span');
                var full_img = document.createElement('img');
                full_img.className = "full_img"
                full_img.src = "img/soeasy_full.png"
                // var input = document.createElement('input');
                // input.type= "radio";
                // td.appendChild(input);
    
                td.appendChild(div_flex);
                // 加入span
                div_flex.appendChild(div_date);
                div_date.appendChild(span);
                // 加入div
                div_flex.appendChild(div);
                // div裡加入三個時間段
                morning.classList.add("period");
                afternoon.classList.add("period");
                night.classList.add("period");
                div.appendChild(morning);
                div.appendChild(afternoon);
                div.appendChild(night);
                
                // span裡面放入日期
                span.innerHTML = actual.getDate();
    
                // 早中晚加入文字
                morning.innerText = "早";
                afternoon.innerText = "中";
                night.innerText = "晚";
    
                // 隨機
                var arr = Math.round(Math.random());
                var re_index = 0;
                if (arr==1) {
                    morning.classList.add("reserved");
                    re_index++;
                }
                
                arr = Math.round(Math.random());
                if (arr==1) {
                    afternoon.classList.add("reserved");
                    re_index++;
                }
                
                arr = Math.round(Math.random());
                if (arr==1) {
                    night.classList.add("reserved");
                    re_index++;
                }
    
                // fora=非此月
                if(actual.getMonth() !== data.getMonth() )
                    td.className = 'fora';
                // ------------------新增 今天以前不能被點擊
                
                let dp = new Date();
                let month00 = dp.getMonth(); // 現在月份
                if(actual.getDate() <= data.getDate() && actual.getMonth() <= month00){
                    td.className = 'fora';
                }
                // if(actual.getMonth() < month00){
                //     td.className = 'fora';
                // }
    
                // today=今天
                if(data.getDate() == actual.getDate() &&
                data.getMonth() == month00)
                td.className = 'today';
                
                // t_add3=今天後三天
                if(data.getDate() == actual.getDate()-3 &&
                data.getMonth() == actual.getMonth())
                    td.classList.add('t_add3');
                
                // 三時段皆滿
                if(re_index == 3){
                    td.classList.add('full');
                    td.appendChild(full_img);
                }

                // 這個月以前不能回去 boto_prev disable
                // console.log(data.getMonth()); // 1 二月
                // console.log(month00); // 1 二月
                if(data.getMonth() == month00){
                    boto_prev.disabled = true;
                    boto_prev.style.opacity = 0.3;
                }

                actual.setDate(actual.getDate()+1);
                fila.appendChild(td);
    
                // -----註冊點擊事件
                
                let tds = document.querySelectorAll("#calendari td");
                for(let i=0; i<tds.length; i++){
                    if(tds[i].className.indexOf('fora') == -1 && tds[i].className.indexOf('today') == -1 && tds[i].className.indexOf('full') == -1){
                        tds[i].onclick=function(e){
                            // 抓裡面的日期
                            // tds[i] 是這個被點到的格子
                            // data.getDate() 是今天的日期
                            // actual.getMonth() 月曆上顯示的月份!!
                            let selectedYear = data.getFullYear(); // 年
                            let selectedMonth = actual.getMonth(); // 月
                            let selectedDay = tds[i].childNodes[0].childNodes[0].innerText; // 日
                            let selectedDate = `${selectedYear}年${selectedMonth}月${selectedDay}日`
                            document.getElementById("selectedDate").innerText = selectedDate;
                            
                            // console.log(e.target);
                            
                        }  
                    }
                    
                }

                let periods = document.querySelectorAll(".period");
                var selectedPeriod;
                for(let i=0; i<periods.length; i++){
                    if(periods[i].className.indexOf('reserved') == -1){
                        periods[i].onclick = function(){
                            let period = periods[i].innerText;
                            if(period=="早"){
                                selectedPeriod = '早上9-12點';
                            }else if(period=="中"){
                                selectedPeriod = '下午14-17點';
                            }else if(period=="晚"){
                                selectedPeriod = '晚上18-21點';
                            }
                            // console.log(selectedPeriod);
                            document.getElementById("selectedPeriod").innerText = selectedPeriod;
                        }
                    }
                }
            }
            
            e.appendChild(fila);
        }
        
        setTimeout(function() {
            e.className = 'actiu';
            original.className +=
            diff === 0 ? ' last_m' : ' next_m';
        }, 20);
        
        original.className = 'inactiu';
        
        setTimeout(function() {
            var inactius = document.getElementsByClassName('inactiu');
            for(var i = 0; i < inactius.length; i++)
            widget.removeChild(inactius[i]);
        }, 1000);
        
    }
    
    calendari(document.getElementById('calendari'), new Date());
}
window.addEventListener('load',createCalendar);
// 加上選到的效果
// tds[i].classList.add("selected");