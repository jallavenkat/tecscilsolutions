<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sql extends CI_Model {
	public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
    }
	
	public function getSiteInfo()
	{
		$this->db->select("*")->from("configurations")->where(array('status' => 1));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function checkLogin($email,$password)
	{
		$this->db->select("*")->from("users")->where(array("email" => $email, "password" => $password, 'status' => 1,"usertype" => 1));
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function checkUserLogin($email,$password)
	{
		$this->db->select("*")->from("users")->where(array("email" => $email, "password" => $password, 'status' => 1))->where_not_in("usertype",array(1));
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function updateItems($table,$params,$where)
	{
		$query = $this->db->update($table,$params,$where);
		//echo $this->db->last_query();
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function storeItems($table,$params)
	{
		$query = $this->db->insert($table,$params);
		//echo $this->db->last_query();
		if($query)
		{
			return $this->db->insert_id();
		}
		else{
			return 0;
		}
	}
	public function storeBatchItems($table,$params)
	{
		$query = $this->db->insert_batch($table,$params);
		//echo $this->db->last_query();
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function getTableAllData($table)
	{
		$this->db->select("*")->from($table)->order_by("id","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableAllDataOrder($table,$column,$order)
	{
		$this->db->select("*")->from($table)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getTableRowData($table,$where)
	{
		$this->db->select("*")->from($table)->where($where)->order_by("id","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getTableRowDataOrder($table,$where,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderLimit($table,$where,$limit,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->limit($limit,0)->order_by($column,$order);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderLimitStart($table,$where,$start,$end,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->limit($end,$start)->order_by($column,$order);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataArray($table,$where,$array,$column)
	{
		$this->db->select("*")->from($table)->where($where)->where_in($column,$array)->order_by("id","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataArrayOrder($table,$where,$array,$column,$ordercol,$orderVal)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_in($column,$array)->order_by($ordercol,$orderVal);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else{
			return array();
		}
	}
	public function getTableRowDataArrayOrderLimit($table,$where,$array,$column,$ordercol,$orderVal,$start,$end)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_in($column,$array)->order_by($ordercol,$orderVal)->limit($end,$start);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else{
			return array();
		}
	}
	public function getTableRowDataNoWhereArray($table,$array,$column)
	{
		$this->db->select("*")->from($table)->where_in($column,$array)->order_by("id","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataNoWhereArrayOrder($table,$array,$column,$ordercol,$orderval)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where_in($column,$array)->order_by($ordercol,$orderval);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else
		{
			return array();
		}
		
	}
	public function getTableLimitData($table,$where,$limit,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->limit($limit,0)->order_by($column,$order);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getTableRowDataNotIn($table,$where,$column,$array)
	{
		$this->db->select("*")->from($table)->where($where)->where_not_in($column,$array);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataNotInLimit($table,$where,$column,$array,$start,$end)
	{
		$this->db->select("*")->from($table)->where($where)->where_not_in($column,$array)->order_by("id","DESC")->limit($end,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataNotInLimitOrder($table,$where,$column,$array,$start,$end,$ocol,$order)
	{
		$this->db->select("*")->from($table)->where($where)->where_not_in($column,$array)->order_by($ocol,$order)->limit($end,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderArray($table,$arrayCol,$arrayVals,$column,$order)
	{
		if(@sizeOf($arrayVals) > 0)
		{
			$this->db->select("*")->from($table)->where_in($arrayCol,$arrayVals)->order_by($column,$order);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else{
			return array();
		}
	}
	public function getTableRowDataGroupOrder($table,$where,$column,$order,$groupColumn)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order)->group_by($groupColumn);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataGroupOrderParams($table,$groupcol,$where,$column,$order,$groupColumn)
	{
		$this->db->select($groupcol)->from($table)->where($where)->order_by($column,$order)->group_by($groupColumn);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function removeOldItem($table,$column, $where, $folderpath)
	{
		$this->db->select("*")->from($table)->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			$res=$query->result();
			if(@sizeOf($res) > 0)
			{
				//echo FCPATH."".$folderpath.$res[0]->$column;
				unlink(FCPATH."".$folderpath.$res[0]->$column);
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}
	public function removeProductImageItem($table,$column, $where, $folderpath)
	{
		$this->db->select("*")->from($table)->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			$res=$query->result();
			if(@sizeOf($res) > 0)
			{
				$exp = @explode(".",$res[0]->$column);
				$f=$exp[0]."_thumb.".@end($exp);
				//echo FCPATH."".$folderpath.$res[0]->$column;
				unlink(FCPATH."".$folderpath.$res[0]->$column);
				unlink(FCPATH."".$folderpath."small/".$f);
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}
	public function removeOldFolderItem($table,$column, $where, $folderpath)
	{
		$this->db->select("*")->from($table)->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			$res=$query->result();
			if(@sizeOf($res) > 0)
			{
				//echo FCPATH."".$folderpath.$res[0]->$column;
				unlink(FCPATH."".$folderpath.$res[0]->$column);
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function removeItems($table,$where)
	{
		$query = $this->db->delete($table,$where);
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function removeRowItems($table,$where)
	{
		$query = $this->db->delete($table,$where);
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function checkItemExists($table,$where)
	{
		$this->db->select("*")->from($table)->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
		
	public function getTableRowMinMaxData($table,$where)
	{
		$this->db->select("min(pSellPrice) as minprice, max(pSellPrice) as maxprice")->from($table)->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getSearchByParams($keywords,$location,$qualification)
	{
		if(@$keywords != '')
		{
			$this->db->group_start();
			$this->db->like("LOWER(pTitle)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->or_like("LOWER(pDesc)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->or_like("LOWER(pSkills)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->group_end();
		}
		if(@$location != '')
		{
			$this->db->where("pLocation",$location);
		}
		if(@$qualification != '')
		{
			$this->db->like("pQualification",@strtolower(str_replace("-"," ",$qualification)));
		}
		$this->db->select("*")->from("posts")->where(array("status" => 1))->order_by("id","DESC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getSearchByParamsLimit($keywords,$location,$qualification,$start,$end)
	{
		if(@$keywords != '')
		{
			$this->db->group_start();
			$this->db->like("LOWER(pTitle)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->or_like("LOWER(pDesc)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->or_like("LOWER(pSkills)",@strtolower(str_replace("-"," ",$keywords)));
			$this->db->group_end();
		}
		if(@$location != '')
		{
			$this->db->where("pLocation",$location);
		}
		if(@$qualification != '')
		{
			$this->db->like("pQualification",@strtolower(str_replace("-"," ",$qualification)));
		}
		$this->db->select("*")->from("posts")->where(array("status" => 1))->limit($end,$start)->order_by("id","DESC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataNotWhereLimit($table,$where,$col,$value,$limit)
	{
		$this->db->select("*")->from($table)->where($where)->where_not_in($col,$value)->limit($limit,0)->order_by("id","DESC");
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getProductsByKeys($words)
	{
		$query = $this->db->query("select id from products");
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function removeMultipleImage($table,$where)
	{
		$query = $this->db->select("*")->from($table)->where($where)->get();
		if($query->num_rows() > 0)
		{
			$res = $query->result();
			$ex=@explode(".",$res[0]->pImage);
			$img=$ex[0]."_thumb.".end($ex);
			unlink(FCPATH."uploads/products/210_210/".$img);
			unlink(FCPATH."uploads/products/425_425/".$img);
			unlink(FCPATH."uploads/products/".$res[0]->pImage);
			$qry = $this->db->delete($table,$where);
			if($qry)
			{
				return 1;
			}
			else{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function removeImage($table,$folder,$where,$column)
	{
		$query = $this->db->select("*")->from($table)->where($where)->get();
		if($query->num_rows() > 0)
		{
			$res = $query->result();
			unlink(FCPATH."uploads/".$folder."/".$res[0]->$column);
			return 1;
			
		}
		else
		{
			return 0;
		}
	}
	
	public function getTableRowLikeData($table,$keyword,$column)
	{
		$query = $this->db->select("*")->from($table)->like($column,$keyword)->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getProductsByParams($categoryid, $categoryarray,$colorattr,$sizeattrIds,$rangeattr,$sort, $lastRec,$end=null)
	{
		if(@sizeOf($colorattr) > 0)
		{
			$this->db->where_in("b.pColors",$colorattr);			
		}

		if(@sizeOf($sizeattrIds) > 0)
		{
			$this->db->where_in("a.id",$sizeattrIds);
		}
		
		if($categoryid != '' && $categoryid != '0')
        {
            $this->db->where(array("b.catid"=>$categoryid));
        }
        if(@sizeOf($categoryarray) > 0)
        {
            $this->db->where_in("b.sCatid",$categoryarray);
        }

        if(@sizeOf($rangeattr) > 0)
		{
			$rvals=array();
			for($e=0;$e<sizeOf($rangeattr);$e++)
			{
				$exp=@explode("-",$rangeattr[$e]);
				if(@sizeOf($exp) > 0)
				{
					for($v=0;$v<sizeOf($exp);$v++)
					{
						$rvals[] =$exp[$v];
					}
				}
			}
			$maxVAl=@max($rvals);
			$minVAl=@min($rvals);

			$this->db->where(array("b.pSellPrice >= " => (float) $minVAl,"b.pSellPrice <= " =>(float) $maxVAl));
		}
		if(@$sort == 'popular')
		{
			$this->db->order_by("b.pViews","DESC");
		}
		if(@$sort == 'latest')
		{
			$this->db->order_by("b.id","DESC");

		}
		if(@$sort == 'featured')
		{
			$this->db->where("isFeature",1);
			$this->db->order_by("b.id","DESC");
		}
		if(@$sort == 'asc')
		{
			$this->db->order_by("b.pSellPrice","ASC");
		}
		if(@$sort == 'desc')
		{
			$this->db->order_by("b.pSellPrice","DESC");
		}	

		if(@$lastRec != 0)
		{
			if(@$sort == 'asc')
			{
				$this->db->where(array("b.id >"=>$lastRec));
			}
			else
			{
				$this->db->where(array("b.id <"=>$lastRec));
			}
		}
		 if(@$end != '')
        {
        	$this->db->limit(@$end,0);
        }
		$this->db->group_by('b.id'); 
        $this->db->select("a.id as aid,b.*")->from("productattributes a")->where(array("a.status"=>1,"b.status"=>1));
        $this->db->join("products b","b.id = a.productid","LEFT");

        $query=$this->db->get();
        //echo "<br>".$this->db->last_query();
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }

	}
	public function getAttributes($colorattr)
	{
		//echo "string";
		$attrId = array();
		if(@sizeOf($colorattr) > 0)
		{
			$query1 = $this->db->select("*")->from("productattributes")->where_in("attrValue",$colorattr)->get();
			if($query1->num_rows() > 0)
			{
				$res=$query1->result();
				for($r=0;$r<sizeOf($res);$r++)
				{
					$attrId[]=$res[$r]->id;
				}
				return $attrId;
			}
			else
			{
				return 0;
			}
		}
		
		//die();
	}
	/*public function getProductsByParamsLimit($categoryid, $categoryarray,$colorattr,$sizeattr,$rangeattr,$sort, $lastRec,$end)
	{
		if(@sizeOf($colorattr) > 0)
		{
			$this->db->where_in("b.pColors",$colorattr);			
		}

		if(@sizeOf($sizeattrIds) > 0)
		{
			$this->db->where_in("a.id",$sizeattrIds);
		}
		if($categoryid != '' && $categoryid != '0')
        {
            $this->db->where(array("b.catid"=>$categoryid));
        }
        if(@sizeOf($categoryarray) > 0)
        {
            $this->db->where_in("b.sCatid",$categoryarray);
        }
        if(@sizeOf($rangeattr) > 0)
		{
			$rvals=array();
			for($e=0;$e<sizeOf($rangeattr);$e++)
			{
				$exp=@explode("-",$rangeattr[$e]);
				if(@sizeOf($exp) > 0)
				{
					for($v=0;$v<sizeOf($exp);$v++)
					{
						$rvals[] =$exp[$v];
					}
				}
			}
			$maxVAl=@max($rvals);
			$minVAl=@min($rvals);
		
			$this->db->where(array("b.pSellPrice >= " => (float) $minVAl,"b.pSellPrice <= " =>(float) $maxVAl));
		}
		if(@$sort == 'popular')
		{
			$this->db->order_by("b.pViews","DESC");
		}
		if(@$sort == 'latest')
		{
			$this->db->order_by("b.id","DESC");

		}
		if(@$sort == 'featured')
		{
			$this->db->where("isFeature",1);
			$this->db->order_by("b.id","DESC");
		}
		if(@$sort == 'asc')
		{
			$this->db->order_by("b.pSellPrice","ASC");
		}
		if(@$sort == 'desc')
		{
			$this->db->order_by("b.pSellPrice","DESC");
		}
		if(@$lastRec != 0)
		{
			if(@$sort == 'asc')
			{
				$this->db->where(array("b.id >"=>$lastRec));
			}
			else
			{
				$this->db->where(array("b.id <"=>$lastRec));
			}
		}
		$this->db->group_by('b.id'); 
        $this->db->select("a.id as aid,b.*")->from("productattributes a")->where(array("a.status"=>1,"b.status"=>1));
        $this->db->join("products b","b.id = a.productid","LEFT");
        $this->db->limit(@$end,0);
        echo "<br>===<br>".$this->db->last_query();
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
	}*/
	
	public function getFilterProductsByParams($categoryid, $categoryarray,$attributearray)
	{
		$productids=array();
		if(@sizeOf($attributearray) > 0)
		{
			$query1 = $this->db->select("*")->from("productattributes")->where_in("attrValue",$attributearray)->get();
			//echo $this->db->last_query();
			if($query1->num_rows() > 0)
			{
				$res=$query1->result();
				for($r=0;$r<sizeOf($res);$r++)
				{
					$productids[]=$res[$r]->productid;
				}
			}
		}
		$productids=array_unique($productids);
		$where='';
		if(@sizeOf($categoryarray) > 0)
		{
			$where .= 'and sCatid in('.@implode(",",$categoryarray).')';
		}
		if(@sizeOf($productids) > 0)
		{
			$where .= 'and id in('.@implode(",",$productids).')';
		}
		$query = $this->db->query("select * from products where (catid=".$categoryid." or sCatid = ".$categoryid.") ".$where." order by id DESC");
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getFilterProductsByParamsLimit($categoryid, $categoryarray,$attributearray,$end)
	{
		$productids=array();
		if(@sizeOf($attributearray) > 0)
		{
			$query1 = $this->db->select("*")->from("productattributes")->where_in("attrValue",$attributearray)->get();
			//echo $this->db->last_query();
			if($query1->num_rows() > 0)
			{
				$res=$query1->result();
				for($r=0;$r<sizeOf($res);$r++)
				{
					$productids[]=$res[$r]->productid;
				}
			}
		}
		$productids=array_unique($productids);
		$where='';
		if(@sizeOf($categoryarray) > 0)
		{
			$where .= 'and sCatid in('.@implode(",",$categoryarray).')';
		}
		if(@sizeOf($productids) > 0)
		{
			$where .= 'and id in('.@implode(",",$productids).')';
		}
		
		$query = $this->db->query("select * from products where (catid=".$categoryid." or sCatid = ".$categoryid.") ".$where." order by id DESC limit 0,".@$end." ");
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getCategorywiseProducts($categoryid)
	{
		$query = $this->db->query("select * from products where (catid=".$categoryid." or sCatid = ".$categoryid.") order by id DESC");
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function checkCouponCode($coupon,$catsids,$subcatsids,$productId,$qty,$price)
	{ 
		$cdate=@date("Y-m-d");
		if(@sizeOf($catsids) > 0)
		{
			if(@sizeOf($subcatsids) > 0)
			{
				$this->db->select("*")->from('coupons')->where(array("cCode" => strtoupper($coupon),'isUsed' => 0,'status' => 1,"categoryid"=>$catsids,"subcategoryid"=>$subcatsids,"cValidFrom <="=>$cdate,"cValidTo >="=>$cdate))->order_by("id","DESC");
				$query = $this->db->get();
				if($query->num_rows() > 0)
				{
					$result =  $query->result();
					$cDiscount = @$result[0]->cDiscount;
					$totalAmt = ((@$price*@$result[0]->cDiscount)/100)*$qty;
					return $totalAmt;
				}
				else
				{
					$this->db->select("*")->from('coupons')->where(array("categoryid"=>$catsids,"subcategoryid"=>'all',"cCode" => strtoupper($coupon),'status' => 1,'isUsed' => 0,"cValidFrom <="=>$cdate,"cValidTo >="=>$cdate))->order_by("id","DESC");
					$query = $this->db->get();
					if($query->num_rows() > 0)
					{
						$result =  $query->result();
						$cDiscount = @$result[0]->cDiscount;
						$totalAmt = ((@$price*@$result[0]->cDiscount)/100)*$qty;
						return $totalAmt;

					}
					else
					{
						$this->db->select("*")->from('coupons')->where(array("categoryid"=>'all',"cCode" => strtoupper($coupon),'status' => 1,'isUsed' => 0,"cValidFrom <="=>$cdate,"cValidTo >="=>$cdate))->order_by("id","DESC");
						$query = $this->db->get();
						if($query->num_rows() > 0)
						{
							$result =  $query->result();
							$cDiscount = @$result[0]->cDiscount;
							$totalAmt = ((@$price*@$result[0]->cDiscount)/100)*$qty;
							return $totalAmt;
						}
						else
						{
							return 0;
						}
					}
				}
			}
			else
			{
				$this->db->select("*")->from('coupons')->where(array("cCode" => strtoupper($coupon),'isUsed' => 0,'status' => 1,"categoryid"=>$catsids,"cValidFrom <="=>$cdate,"cValidTo >="=>$cdate))->order_by("id","DESC");
				$query = $this->db->get();
				if($query->num_rows() > 0)
				{
					$result =  $query->result();
					$cDiscount = @$result[0]->cDiscount;
					$totalAmt = ((@$price*@$result[0]->cDiscount)/100)*$qty;
					return $totalAmt;
				}
				else
				{
					$this->db->select("*")->from('coupons')->where(array("categoryid"=>'all',"cCode" => strtoupper($coupon),'status' => 1,'isUsed' => 0,"cValidFrom <="=>$cdate,"cValidTo >="=>$cdate))->order_by("id","DESC");
					$query = $this->db->get();
					if($query->num_rows() > 0)
					{
						$result =  $query->result();
						$cDiscount = @$result[0]->cDiscount;
						$totalAmt = ((@$price*@$result[0]->cDiscount)/100)*$qty;
						return $totalAmt;
					}
					else
					{
						return 0;
					}
				}
			}
		}
		else
		{
			return 0;
		}
		
	}
	public function GetRow($keyword,$itemType=null) {  

		if($itemType != '0' &&  $itemType != 'undefined')
        {
            if($itemType == 1)
            {
                 $this->db->order_by("pSellPrice","ASC");
            }
            if($itemType == 2)
            {
                 $this->db->order_by("pSellPrice","DESC");
            }
            
        }
		$this->db->select("*")->from('products')->where(array("status" => 1));      

        $this->db->like("pTitle", $keyword);

        $query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
    public function getCatInfoByIds($cat_status,$ids)
    {
        $this->db->select("*")->from('categories')->where(array("status"=>1))->where_in("id",$ids)->order_by("id","ASC");
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else{
            return array();
        }
    }
    public function getProductIds()
    {
        $this->db->select("productId")->from('orderitems')->where(array("status"=>1,"orderStatus"=>1))->group_by('productId')->order_by("id","DESC")->limit(25);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else{
            return array();
        }
    }
	
	public function getTableRowByQuery($sql)
	{
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
}