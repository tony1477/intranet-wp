<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employee';
    protected $primaryKey       = 'employeeid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['employeecode','fullname'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPointLevel($sort='desc')
    {
        return $this->db->query("select zzz.name, zzz.totalpoint, employeecode, position,user_image from (select name, (point1+point2) as `totalpoint`, employeeid,position,user_image from
        (
            select z.name, sum(z.point1) as `point1`, sum(z.point2) as `point2`, employeeid, position, user_image from
            (
                select (m.point) as `point1`, m.monthly, (select position from employee e where e.employeeid = m.employeeid) as position, (select fullname from employee e where e.employeeid = m.employeeid) as name, m2.description, ifnull(u.user_image,'default.png') as user_image,
                ifnull(m2.`point`,0) as point2, m.employeeid, m.employeecode
                from monthlyabs m
                left join monthlyabsdetail m2 on m2.monthlyabsid = m.monthlyabsid
                left join users u on u.employeeid = m.employeeid
                join employee e on e.employeeid = m.employeeid
                where m.monthly in (1,2,3,4,5,6,7,8)
                and e.isexcept=0
            ) z group by z.name
        ) zz ) zzz
        join monthlyabs m3 on m3.employeeid = zzz.employeeid
        where m3.monthly=1
        order by totalpoint {$sort} limit 3");
    }

    public function getPoints()
    {
        return $this->db->query("select z.nama, sum(z.point1) as `point1`, sum(z.point2) as `point2` from
        (
            select (m.point) as `point1`, m.monthly, (select fullname from employee e where e.employeeid = m.employeeid) as nama, m2.description ,
            ifnull(m2.`point`,0) as point2
            from monthlyabs m
            left join monthlyabsdetail m2 on m2.monthlyabsid = m.monthlyabsid
            where m.monthly in (1,2,3,4,5,6,7,8)
        ) z
        group by z.nama");
    }

    public function getPointEmployee($id)
    {
        return $this->db->query('select employeecode,periode,(point+point2) as point, monthlyabsid from (select employeecode, m.monthlyabsid,
        cast(concat(yearly,"-",monthly,"-01") as date) as periode,
        m.`point`, (select ifnull(sum(point),0) 
        from monthlyabsdetail m2 where m2.monthlyabsid=m.monthlyabsid) as point2
        from monthlyabs m
        join users u on u.employeeid = m.employeeid 
        where u.id = :id:) z ',['id'=>$id]);
    }

    public function getPointDetailbyPeriode($id)
    {
        return $this->db->query('select (point) as point1, (select ifnull(sum(point),0) from monthlyabsdetail m2 where m2.monthlyabsid = m.monthlyabsid) as point2 
        from monthlyabs m 
        where m.monthlyabsid = :id:',['id'=>$id]);
    }
}
