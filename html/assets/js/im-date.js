var today = new Date(),
            s_year = $("#js_selectYear"),
            s_month = $("#js_selectMon"),
            s_date = $("#js_selectDate"),
            dateArr_1 = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
            dateArr_2 = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
            yearStr = "",
            monStr = "";

        //年份遍历，从1970年开始
        for (var i = 1970; i < today.getFullYear() + 1; i++) {
            yearStr += "<option value='" + i + "'>" + i + "</option>";
        }
        s_year.html(yearStr);

        //月份遍历
        for (var j = 1; j < 13; j++) {
            monStr += "<option value='" + j + "'>" + j + "</option>";
        }
        s_month.html(monStr);

        //天数填充
        dateCal("1970", "1");

        //日期的填充在选择了月份之后
        s_month.on("change", "", function () {
            dateCal(s_year.val(), $(this).val());
        });

        //年份改变时，天数需要清零
        s_year.on("change", "", function () {
            dateCal($(this).val(), s_month.val());
        });

        function dateCal(y, m) {
            var month_days, days_str;
            if (y % 4 == 0) {
                month_days = dateArr_2[m - 1];
            }
            else {
                month_days = dateArr_1[m - 1];
            }

            for (var k = 1; k < month_days + 1; k++) {
                days_str += "<option value='" + k + "'>" + k + "</option>";
            }
            s_date.html(days_str);
        }