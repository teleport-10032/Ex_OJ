import lorun
import os
import pymysql
import io
import sys
import time
import datetime

RESULT_STR = [
    'Accepted',
    'Presentation Error',
    'Time Limit Exceeded',
    'Memory Limit Exceeded',
    'Wrong Answer',
    'Runtime Error',
    'Output Limit Exceeded',
    'Compile Error',
    'System Error'
]

def runone(p_path, in_path, out_path):
    fin = open(in_path)
    ftemp = open('temp.out', 'w')

    runcfg = {
        'args':['./m'],
        'fd_in':fin.fileno(),
        'fd_out':ftemp.fileno(),
        'timelimit':1000, #in MS
        'memorylimit':256000, #in KB
    }

    rst = lorun.run(runcfg)
    fin.close()
    ftemp.close()

    if rst['result'] == 0:
        ftemp = open('temp.out')
        fout = open(out_path)
        crst = lorun.check(fout.fileno(), ftemp.fileno())
        fout.close()
        ftemp.close()
        os.remove('temp.out')
        if crst != 0:
            return {'result':crst}

    return rst

#python3 test.py a+b.c testdata 3
#源程序文件路径 测试样例路径 测试样例组数



def judge(td_path, td_total,submit_id,user_mail,problem):
    re=""
    r = os.system('gcc /var/www/html/judger/src_file/src_file.c -o m')
    if r == 0:
        flag = 0
        for i in range(td_total):
            in_path = os.path.join(td_path, '%d.in'%i)
            out_path = os.path.join(td_path, '%d.out'%i)
            if os.path.isfile(in_path) and os.path.isfile(out_path):
                rst = runone('./m', in_path, out_path)
                rst['result'] = RESULT_STR[rst['result']]
                if rst["result"] != "Accepted":
                    re = rst["result"]
                    print ("%s，写入" % re)
                    # print (rst)
                    flag = 1
                    db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
                    cursor = db.cursor()
                    sql = "update status set submit_statu='%s' where submit_id=%s" % (re,submit_id)
                    print (sql)
                    try:
                        cursor.execute(sql)
                        db.commit()
                    except:
                        print ("!!")
                        db.rollback()

                    sql = "update user set user_attempt=concat(user_attempt,'.%s'),user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s'" % (
                    problem, user_mail)
                    print (sql)
                    try:
                        cursor.execute(sql)
                        db.commit()
                    except:
                        print ("!!")
                        db.rollback()

                    db.close()
                    break
            if flag == 0:
                re="Accepted"
                print ("AC，写入status")
                print (rst)
                db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
                cursor = db.cursor()
                sql = "update status set submit_statu='Accepted',submit_time=%s,submit_memory=%s where submit_id=%s" % (rst["timeused"],rst["memoryused"],submit_id)
                print (sql)
                try:
                    cursor.execute(sql)
                    db.commit()
                except:
                    print ("!!")
                    db.rollback()

                sql1 = ""
                sql = "select user_accept,user_exp,user_permission  from user where user_mail='%s'" % user_mail
                print (sql)
                try:
                    cursor.execute(sql)
                    results = cursor.fetchall()
                    for row in results:
                        str = row[0]
                        exp = row[1]
                        permission = row[2]
                    p_ac = str.split(".")
                    f1 = 1
                    problem_str = repr(problem)
                    for i in range(1, len(p_ac)):
                        if p_ac[i] == problem_str:
                            f1 = 0
                    #写入user_accpet
                    #该题目第一次AC，exp+12
                    if f1 == 1:
                        sql1 = "update user set user_accept=concat(user_accept,'.%s'),user_ALL_NUM=user_ALL_NUM+1,user_AC_NUM=user_AC_NUM+1,user_exp=user_exp+12 where user_mail='%s'" % (
                        problem, user_mail)
                        try:
                            cursor.execute(sql1)
                            db.commit()
                        except:
                            print ("!!")
                            db.rollback()
                        #判断下是否可以升级
                        #四种不能升级的人
                        if permission != "LV0" and permission != "LV6" and permission != "admin" and permission != "teacher":
                            if exp >= 12000:
                                permission = "LV6"
                            elif exp >= 6480:
                                permission = "LV5"
                            elif exp >= 3200:
                                permission = "LV4"
                            elif exp >= 1500:
                                permission = "LV3"
                            elif exp >= 200:
                                permission = "LV2"
                            else:
                                permission = "LV1"
                            sql2 = "update user set user_permission='%s' where user_mail='%s'" % (permission,user_mail)
                            try:
                                print (sql2)
                                cursor.execute(sql2)
                                db.commit()
                            except:
                                print ("!!")
                                db.rollback()

                    if f1 == 0:
                        sql1 = "update user set user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s'" % (user_mail)
                        try:
                            cursor.execute(sql1)
                            db.commit()
                        except:
                            print ("!!")
                            db.rollback()
                except:
                    print ("!!")
                    db.rollback()

                db.close()

                break
            else:
                print('testdata:%d incompleted' % i)
                os.remove('./m')
                exit(-1)

    else:
        #编译失败
        re="Compile Error"
        print ("编译错误，写入status：")
        db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
        cursor = db.cursor()
        sql = "update status set submit_statu='Compile Error' where submit_id=%s" % submit_id
        try:
            cursor.execute(sql)
            db.commit()
        except:
            db.rollback()

        sql = "update user set user_attempt=concat(user_attempt,'.%s'),user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s '" % (
        problem, user_mail)
        print (sql)
        try:
            cursor.execute(sql)
            db.commit()
        except:
            print ("!!")
            db.rollback()
        db.close()

    # 'Accepted',
    # 'Presentation Error',
    # 'Time Limit Exceeded',
    # 'Memory Limit Exceeded',
    # 'Wrong Answer',
    # 'Runtime Error',
    # 'Output Limit Exceeded',
    # 'Compile Error',
    # 'System Error'

    db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
    cursor = db.cursor()
    sql2 = ""
    if re=="Accepted":
        sql2 = "update problem set problem_AC = problem_AC+1 where problem_id=%s" % problem
    if re=="Presentation Error":
        sql2 = "update problem set problem_PE = problem_PE+1 where problem_id=%s" % problem
    if re=="Time Limit Exceeded":
        sql2 = "update problem set problem_TLE = problem_TLE+1 where problem_id=%s" % problem
    if re=="Memory Limit Exceeded":
        sql2 = "update problem set problem_MLE = problem_MLE+1 where problem_id=%s" % problem
    if re=="Runtime Error":
        sql2 = "update problem set problem_RE = problem_RE+1 where problem_id=%s" % problem
    if re=="Compile Error":
        sql2 = "update problem set problem_CE = problem_CE+1 where problem_id=%s" % problem
    if re == "Time Limit Exceeded":
        sql2 = "update problem set problem_PE = problem_PE+1 where problem_id=%s" % problem
    if re == "Output Limit Exceeded":
        sql2 = "update problem set problem_OLE = problem_OLE+1 where problem_id=%s" % problem

    print (sql2)
    try:
        cursor.execute(sql2)
        db.commit()
    except:
        print ("!!")
        db.rollback()


def judge_contest(td_path, td_total,submit_id,problem):
    re=""
    r = os.system('gcc /var/www/html/judger/src_file/src_file.c -o m')
    if r == 0:
        flag = 0
        for i in range(td_total):
            in_path = os.path.join(td_path, '%d.in'%i)
            out_path = os.path.join(td_path, '%d.out'%i)
            if os.path.isfile(in_path) and os.path.isfile(out_path):
                rst = runone('./m', in_path, out_path)
                rst['result'] = RESULT_STR[rst['result']]
                if rst["result"] != "Accepted":
                    re = rst["result"]
                    print ("%s，写入" % re)
                    # print (rst)
                    flag = 1
                    db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
                    cursor = db.cursor()
                    sql = "update contest_status set submit_statu='%s' where submit_id=%s" % (re,submit_id)
                    print (sql)
                    try:
                        cursor.execute(sql)
                        db.commit()
                    except:
                        print ("!!")
                        db.rollback()

                    # sql = "update user set user_attempt=concat(user_attempt,'.%s'),user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s'" % (
                    # problem, user_mail)
                    # print (sql)
                    # try:
                    #     cursor.execute(sql)
                    #     db.commit()
                    # except:
                    #     print ("!!")
                    #     db.rollback()

                    db.close()
                    break
            if flag == 0:
                re="Accepted"
                print ("AC，写入status")
                print (rst)
                db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
                cursor = db.cursor()
                sql = "update contest_status set submit_statu='Accepted',submit_time=%s,submit_memory=%s where submit_id=%s" % (rst["timeused"],rst["memoryused"],submit_id)
                print (sql)
                try:
                    cursor.execute(sql)
                    db.commit()
                except:
                    print ("!!")
                    db.rollback()

                # sql1 = ""
                # sql = "select user_accept from user where user_mail='%s'" % user_mail
                # print (sql)
                # try:
                #     cursor.execute(sql)
                #     results = cursor.fetchall()
                #     for row in results:
                #         str = row[0]
                #     p_ac = str.split(".")
                #     f1 = 1
                #     problem_str = repr(problem)
                #     for i in range(1, len(p_ac)):
                #         if p_ac[i] == problem_str:
                #             f1 = 0
                #     #写入user_accpet
                #     #该题目第一次AC，exp+10
                #     if f1 == 1:
                #         sql1 = "update user set user_accept=concat(user_accept,'.%s'),user_ALL_NUM=user_ALL_NUM+1,user_AC_NUM=user_AC_NUM+1,user_exp=user_exp+10 where user_mail='%s'" % (
                #         problem, user_mail)
                #
                #     if f1 == 0:
                #         sql1 = "update user set user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s'" % (user_mail)
                # except:
                #     print ("!!")
                #     db.rollback()

                # print (sql1)
                # try:
                #     cursor.execute(sql1)
                #     db.commit()
                # except:
                #     print ("!!")
                #     db.rollback()
                # db.close()

                break
            else:
                print('testdata:%d incompleted' % i)
                os.remove('./m')
                exit(-1)
    else:
        #编译失败
        re="Compile Error"
        print ("编译错误，写入status：")
        db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
        cursor = db.cursor()
        sql = "update contest_status set submit_statu='Compile Error' where submit_id=%s" % submit_id
        try:
            cursor.execute(sql)
            db.commit()
        except:
            db.rollback()

        # sql = "update user set user_attempt=concat(user_attempt,'.%s'),user_ALL_NUM=user_ALL_NUM+1 where user_mail='%s '" % (
        # problem, user_mail)
        # print (sql)
        # try:
        #     cursor.execute(sql)
        #     db.commit()
        # except:
        #     print ("!!")
        #     db.rollback()
        db.close()

    # 'Accepted',
    # 'Presentation Error',
    # 'Time Limit Exceeded',
    # 'Memory Limit Exceeded',
    # 'Wrong Answer',
    # 'Runtime Error',
    # 'Output Limit Exceeded',
    # 'Compile Error',
    # 'System Error'

    db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
    cursor = db.cursor()
    sql2 = ""
    if re=="Accepted":
        sql2 = "update problem set problem_AC = problem_AC+1 where problem_id=%s" % problem
    if re=="Presentation Error":
        sql2 = "update problem set problem_PE = problem_PE+1 where problem_id=%s" % problem
    if re=="Time Limit Exceeded":
        sql2 = "update problem set problem_TLE = problem_TLE+1 where problem_id=%s" % problem
    if re=="Memory Limit Exceeded":
        sql2 = "update problem set problem_MLE = problem_MLE+1 where problem_id=%s" % problem
    if re=="Runtime Error":
        sql2 = "update problem set problem_RE = problem_RE+1 where problem_id=%s" % problem
    if re=="Compile Error":
        sql2 = "update problem set problem_CE = problem_CE+1 where problem_id=%s" % problem
    if re == "Time Limit Exceeded":
        sql2 = "update problem set problem_PE = problem_PE+1 where problem_id=%s" % problem
    if re == "Output Limit Exceeded":
        sql2 = "update problem set problem_OLE = problem_OLE+1 where problem_id=%s" % problem

    print (sql2)
    try:
        cursor.execute(sql2)
        db.commit()
    except:
        print ("!!")
        db.rollback()

if __name__ == '__main__':
    var = 1
    rst = ""
    while var == 1:
        db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
        cursor = db.cursor()
        sql = "select submit_id,submit_user_mail,submit_problem,submit_statu,submit_language,submit_text from status order by submit_when desc"
        try:
            cursor.execute(sql)
            results = cursor.fetchall()
            id_s = []
            user_mail_s = []
            problem_s = []
            statu_s = []
            language_s = []
            text_s = []
            qwq = 0
            for row in results:
                id_s.append(row[0])
                user_mail_s.append(row[1])
                problem_s.append(row[2])
                statu_s.append(row[3])
                language_s.append(row[4])
                text_s.append(row[5])
                qwq += 1

            for i in range(0, qwq):
                if statu_s[i] == "Queueing":

                    src_file = "/var/www/html/judger/src_file/src_file.c"
                    f = open(src_file, "w")
                    f.write(text_s[i])
                    f.flush()
                    f.close

                    print ("读取此文件内容")
                    fa = open(src_file, "r")
                    far = fa.read()
                    print (far)
                    fa.close

                    test_case_dir_a = "/var/www/html/judger/test_case/"
                    test_case_dir = test_case_dir_a + str(problem_s[i])
                    os.chdir(test_case_dir)
                    cnt = 0
                    inn = ".in"
                    outt = ".out"
                    for it in range(0, 1000):
                        if os.path.exists(str(it) + inn) and os.path.exists(str(it) + outt):
                            cnt += 1
                    # print (text_s[i])
                    judge(test_case_dir, cnt, id_s[i],user_mail_s[i],problem_s[i])
                    time.sleep(0.5)
        except Exception as e1:
            print("Error")
            print(str(e1))
        db.close()

        db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
        cursor = db.cursor()
        sql = "select submit_id,submit_statu,submit_text,submit_problem from contest_status order by submit_when desc"
        try:
            cursor.execute(sql)
            results = cursor.fetchall()
            id_s = []
            statu_s = []
            text_s = []
            problem_s = []
            qwq = 0
            for row in results:
                id_s.append(row[0])
                statu_s.append(row[1])
                text_s.append(row[2])
                problem_s.append(row[3])
                qwq += 1

            for i in range(0, qwq):
                if statu_s[i] == "Queueing":

                    src_file = "/var/www/html/judger/src_file/src_file.c"
                    f = open(src_file, "w")
                    f.write(text_s[i])
                    f.flush()
                    f.close

                    print ("读取此文件内容")
                    fa = open(src_file, "r")
                    far = fa.read()
                    print (far)
                    fa.close

                    test_case_dir_a = "/var/www/html/judger/test_case/"
                    test_case_dir = test_case_dir_a + str(problem_s[i])
                    os.chdir(test_case_dir)
                    cnt = 0
                    inn = ".in"
                    outt = ".out"
                    for it in range(0, 1000):
                        if os.path.exists(str(it) + inn) and os.path.exists(str(it) + outt):
                            cnt += 1
                    # print (text_s[i])
                    judge_contest(test_case_dir, cnt, id_s[i], problem_s[i])
                    time.sleep(0.5)

        except Exception as e2:
            print("Error")
            print(str(e2))

        d = datetime.datetime.now().weekday()
        h = datetime.datetime.now().hour
        m = datetime.datetime.now().minute
        s = datetime.datetime.now().second
        print (d)
        print (h)
        print (m)
        #在周一早晨04:00 - 04:01 按照用户等级更新测试样例下载次数
        if d == 1 and h == 4 and m == 0:
            db = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
            cursor = db.cursor()
            sql = "select user_id,user_permission from user"
            try:
                cursor.execute(sql)
                results = cursor.fetchall()
                for row in results:
                    id = row[0]
                    per = row[1]
                    sql1 = ""
                    if per == "LV2":
                        sql1 = "update user set user_casedownload_times = 1 where user_id=%s" % id
                    if per == "LV3":
                        sql1 = "update user set user_casedownload_times = 2 where user_id=%s" % id
                    if per == "LV4":
                        sql1 = "update user set user_casedownload_times = 4 where user_id=%s" % id
                    if per == "LV5":
                        sql1 = "update user set user_casedownload_times = 6 where user_id=%s" % id
                    if per == "LV6":
                        sql1 = "update user set user_casedownload_times = 8 where user_id=%s" % id
                    print (sql1)
                    db1 = pymysql.connect("localhost", "root", "1021822981", "onlineJudge")
                    cursor1 = db1.cursor()
                    try:
                        cursor1.execute(sql1)
                        db1.commit()
                    except:
                        print ("!!")
                        db1.rollback()
                    db1.close()
            except Exception as e1:
                print("Error")
                print(str(e1))

        time.sleep(2)

#CE不会算入总提交次数