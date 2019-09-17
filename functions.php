<?php

@$mysqli = new Mysqli('127.0.0.1', 'root', 'PASSWORD', 'lib_mgmt', 3306);
if ($mysqli->connect_error) {
    error_log("MySQL: [{$mysqli->connect_errno}] {$mysqli->connect_error}");
}
@$mysqli->set_charset("utf8");

/* == STUDENT == */
/**
 * @param Mysqli $mysql
 * @return array
 */
function get_students($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT stud_no, stud_name FROM Student WHERE 1')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $name);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'name' => $name]);
            }
        }
    }
    return $info;
}

/**
 * @param Mysqli $mysql
 * @param $stud_no
 * @return string|false
 */
function get_student($mysql, $stud_no){
    if($stmt = $mysql->prepare('SELECT stud_name FROM Student WHERE stud_no = ?')){
        $stmt->bind_param('s', $stud_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1){
            $stmt->bind_result($name);
            $stmt->fetch();
            return $name;
        }
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param string $stud_no
 * @param string $stud_name
 * @return bool
 */
function add_student($mysql, $stud_no, $stud_name){
    if($stmt = $mysql->prepare('INSERT INTO Student(stud_no, stud_name) VALUE (?,?)')){
        $stmt->bind_param('ss', $stud_no, $stud_name);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $stud_no
 * @param $stud_name
 * @return bool
 */
function update_student($mysql, $stud_no, $stud_name){
    if($stmt = $mysql->prepare('UPDATE Student SET stud_name = ? WHERE stud_no = ?')){
        $stmt->bind_param('ss', $stud_name, $stud_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $stud_no
 * @return bool
 */
function delete_student($mysql, $stud_no){
    if($stmt = $mysql->prepare('DELETE FROM Student WHERE stud_no = ?')){
        $stmt->bind_param('s', $stud_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/* == BOOK == */

/**
 * @param Mysqli $mysql
 * @return array
 */
function get_books($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT book_no, book_name, author FROM Book WHERE 1')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $name, $author);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'name' => $name, 'author' => $author]);
            }
        }
    }
    return $info;
}

/**
 * @param Mysqli $mysql
 * @param $book_no
 * @return string|false
 */
function get_book($mysql, $book_no){
    if($stmt = $mysql->prepare('SELECT book_name FROM Book WHERE book_no = ?')){
        $stmt->bind_param('s', $book_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1){
            $stmt->bind_result($name);
            $stmt->fetch();
            return $name;
        }
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param string $book_no
 * @param string $book_name
 * @param $author
 * @return bool
 */
function add_book($mysql, $book_no, $book_name, $author){
    if($stmt = $mysql->prepare('INSERT INTO Book(book_no, book_name, author) VALUE (?,?,?)')){
        $stmt->bind_param('sss', $book_no, $book_name, $author);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $book_no
 * @param $book_name
 * @param $author
 * @return bool
 */
function update_book($mysql, $book_no, $book_name, $author){
    if($stmt = $mysql->prepare('UPDATE Book SET book_name = ?, author = ? WHERE book_no = ?')){
        $stmt->bind_param('sss', $book_name, $author, $book_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $book_no
 * @return bool
 */
function delete_book($mysql, $book_no){
    if($stmt = $mysql->prepare('DELETE FROM Book WHERE book_no = ?')){
        $stmt->bind_param('s', $book_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/* == MEMBER == */
/**
 * @param Mysqli $mysql
 * @return array
 */
function get_members($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT mem_no, M.stud_no, stud_name FROM Membership M JOIN Student S ON M.stud_no = S.stud_no')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $stud_no, $name);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'stud_no' => $stud_no, 'name' => $name]);
            }
        }
    }
    return $info;
}

/**
 * @param Mysqli $mysql
 * @param $mem_no
 * @return false|string
 */
function get_member($mysql, $mem_no){
    if($stmt = $mysql->prepare('SELECT stud_name FROM Membership M JOIN Student S ON M.stud_no = S.stud_no WHERE mem_no = ?')){
        $stmt->bind_param('s', $mem_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1){
            $stmt->bind_result($name);
            $stmt->fetch();
            return $name;
        }
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param string $mem_no
 * @param string $stud_no
 * @return bool
 */
function add_member($mysql, $mem_no, $stud_no){
    if($stmt = $mysql->prepare('INSERT INTO Membership(mem_no, stud_no) VALUE (?, ?)')){
        $stmt->bind_param('ss', $mem_no, $stud_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $mem_no
 * @param $stud_no
 * @return bool
 */
function update_member($mysql, $mem_no, $stud_no){
    if($stmt = $mysql->prepare('UPDATE Membership SET stud_no = ? WHERE mem_no = ?')){
        $stmt->bind_param('ss', $stud_no, $mem_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $mem_no
 * @return bool
 */
function delete_member($mysql, $mem_no){
    if($stmt = $mysql->prepare('DELETE FROM Membership WHERE mem_no = ?')){
        $stmt->bind_param('s', $mem_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/* == ISSUE RECORDS == */
/**
 * @param Mysqli $mysql
 * @return array
 */
function get_issues($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT iss_no, iss_date, M.mem_no, stud_name, B.book_no, book_name FROM Iss_rec I JOIN Book B on I.book_no = B.book_no JOIN Membership M on I.mem_no = M.mem_no JOIN Student S on M.stud_no = S.stud_no')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $date, $mem_no, $stud_name, $book_no, $book_name);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'date' => $date, 'mem_no' => $mem_no, 'stud_name' => $stud_name, 'book_no' => $book_no, 'book_name' => $book_name]);
            }
        }
    }
    return $info;
}

/**
 * @param Mysqli $mysql
 * @param $iss_no
 * @param $iss_date
 * @param string $mem_no
 * @param $book_no
 * @return bool
 */
function add_issue($mysql, $iss_no, $iss_date, $mem_no, $book_no){
    if($stmt = $mysql->prepare('INSERT INTO Iss_rec(iss_no, iss_date, mem_no, book_no) VALUE (?, ?, ?, ?)')){
        $stmt->bind_param('isss', $iss_no, $iss_date, $mem_no, $book_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $iss_no
 * @param $iss_date
 * @param $mem_no
 * @param $book_no
 * @return bool
 */
function update_issue($mysql, $iss_no, $iss_date, $mem_no, $book_no){
    if($stmt = $mysql->prepare('UPDATE Iss_rec SET iss_date = ?, mem_no = ?, book_no = ? WHERE iss_no = ?')){
        $stmt->bind_param('sssi', $iss_date, $mem_no, $book_no, $iss_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/**
 * @param Mysqli $mysql
 * @param $iss_no
 * @return bool
 */
function delete_issue($mysql, $iss_no){
    if($stmt = $mysql->prepare('DELETE FROM Iss_rec WHERE iss_no = ?')){
        $stmt->bind_param('i', $iss_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) return true;
    }
    return false;
}

/* Question 3 */

/**
 * @param Mysqli $mysql
 * @param string $date
 * @return array
 */
function question_3($mysql, $date){
    $info = [];
    if($stmt = $mysql->prepare('SELECT Student.stud_no, stud_name, book_name, author FROM Student, Membership, Book, Iss_rec WHERE Student.stud_no = Membership.stud_no AND Membership.mem_no = Iss_rec.mem_no AND Iss_rec.book_no = Book.book_no AND Iss_rec.iss_date = ?')){
        $stmt->bind_param('s', $date);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $std_name, $book_name, $author);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'std_name' => $std_name, 'book_name' => $book_name, 'author' => $author]);
            }
        }
    }
    return $info;
}

/* Question 4 */

/**
 * @param Mysqli $mysql
 * @return array
 */
function question_4($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT Student.stud_no, stud_name, book_name, author FROM Student, Membership, Book, Iss_rec WHERE Student.stud_no = Membership.stud_no AND Membership.mem_no = Iss_rec.mem_no AND Iss_rec.book_no = Book.book_no AND Book.author = \'Andrew S. Tanenbaum\'')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $std_name, $book_name, $author);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'std_name' => $std_name, 'book_name' => $book_name, 'author' => $author]);
            }
        }
    }
    return $info;
}

/* Question 5 */

/**
 * @param Mysqli $mysql
 * @return array
 */
function question_5($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT Student.stud_no, stud_name, COUNT(*) AS books FROM Student, Membership, Iss_rec WHERE Student.stud_no = Membership.stud_no AND Membership.mem_no = Iss_rec.mem_no GROUP BY Student.stud_no, stud_name')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $std_name, $count);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'name' => $std_name, 'count' => $count]);
            }
        }
    }
    return $info;
}

/* Question 6 */

/**
 * @param Mysqli $mysql
 * @return array
 */
function question_6($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT Student.stud_no, stud_name, COUNT(*) AS books FROM Student, Membership, Iss_rec WHERE Student.stud_no = Membership.stud_no AND Membership.mem_no = Iss_rec.mem_no GROUP BY Student.stud_no, stud_name HAVING COUNT(*) = 3;')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $std_name, $count);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'name' => $std_name, 'count' => $count]);
            }
        }
    }
    return $info;
}

/* Question 7 */

/**
 * @param Mysqli $mysql
 * @param $std_no
 * @return array
 */
function question_7($mysql, $std_no){
    $info = [];
    if($stmt = $mysql->prepare('SELECT Student.stud_no, stud_name, book_name, author FROM Student, Membership, Book, Iss_rec WHERE Student.stud_no = Membership.stud_no AND Membership.mem_no = Iss_rec.mem_no AND Iss_rec.book_no = Book.book_no AND Student.stud_no = ?')){
        $stmt->bind_param('s', $std_no);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $std_name, $book_name, $author);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'std_name' => $std_name, 'book_name' => $book_name, 'author' => $author]);
            }
        }
    }
    return $info;
}

/* Question 8 */

/**
 * @param Mysqli $mysql
 * @return array
 */
function question_8($mysql){
    $info = [];
    if($stmt = $mysql->prepare('SELECT DISTINCT Book.book_no, book_name, author FROM Iss_rec, Book WHERE Iss_rec.book_no = Book.book_no AND Iss_rec.iss_date <= NOW() ORDER BY Book.book_no')){
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            for($i = 0; $i < $stmt->num_rows; ++$i){
                $stmt->bind_result($no, $name, $author);
                $stmt->fetch();
                array_push($info, ['no' => $no, 'name' => $name, 'author' => $author]);
            }
        }
    }
    return $info;
}
