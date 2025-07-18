<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\Cate as CateModel;
    use addons\carswxsys\model\News as NewsModel;
    use addons\carswxsys\validate\IDMustBePositiveInt;
    use addons\carswxsys\lib\exception\MissException;

    
    class News extends BaseController
    {
       
        public function getNewslist()
        {
            
            
            $od = "sort desc, createtime desc";
            $map['status'] = 1;
            $map['type'] = 0;
            $limits = 100;
            $Nowpage = 1;
            
            
            $NewsModel = new NewsModel();
            $newslist = $NewsModel->getNewsByWhere($map, $Nowpage, $limits, $od);
            
            
            $CateModel = new CateModel();
            
            $catelist = $CateModel->getCatelist();
            
            
            $data = array('newslist' => $newslist, 'catelist' => $catelist
            
            );
            
            
            return json_encode($data);
            
            
        }
        
        public function getnewslistByCateid()
        {
            
            $cateid = input('post.cateid');
            $od = "sort desc createtime desc";
            $map['status'] = 1;
            $map['type'] = 0;
            $map['cateid'] = $cateid;
            $limits = 100;
            $Nowpage = 1;
            
            
            $NewsModel = new NewsModel();
            $newslist = $NewsModel->getNewsByWhere($map, $Nowpage, $limits, $od);
            
            
            $data = array('newslist' => $newslist);
            
            
            return json_encode($data);
            
            
        }
        
        
        public function getNewsdetail()
        {
            
            
            $id = input('post.id');
            $validate = new IDMustBePositiveInt();
            $validate->goCheck();
            
            
            $map = array('id' => $id);
            
            $NewsModel = new NewsModel();
            
            
            $newsinfo = $NewsModel->getNewsDetail($map);
            
            if (!$newsinfo) {
                throw new MissException(['msg' => '请求数据不存在', 'errorCode' => 40000]);
            }
            
            
            $data = array('newsinfo' => $newsinfo,
            
            );
            
            return json_encode($data);
        }
        
        
    }