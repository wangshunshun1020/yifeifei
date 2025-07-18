import { Home2 } from 'index-model.js';
var home = new Home2(); //实例化 首页 对象


import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();

import { User } from '../../model/user-model.js';

var user  = new User();

var app = getApp();

Page({
    data: {
      
      index: 0,
      multiIndex: [0,0],
      objectMultiArray: [],
      datainfo: '',
      city:'全国',
      cityid:0,
      provinceid:0,

        autoplay: true,
        interval: 3000,
        duration: 1000,
        //是否采用衔接滑动  
        circular: true,
        //是否显示画板指示点  
        indicatorDots: false,
        //选中点的颜色  
        indicatorcolor: "#000",
        //是否竖直  
        vertical: false,
        //是否自动切换  
        //滑动动画时长毫秒  
        //所有图片的高度  
        imgheights: [],
        //图片宽度  
        imgwidth: 750,
        //默认  
        current: 0 ,
        swiperCurrent: 0,
        loadingHidden: false,
        scrollTop:-1,
        isNew:true,
        isPrice:true,
        NewTitle:'最新上架',
        PriceTitle:'价格',
        isuid:1,
        btprice:'',
        brandname:'',
        sysinfo:[],
        isreset:true,
        brandid:0,
        carlen:0
    }, 


    toCarslist:function(){
      var that = this;
        wx.redirectTo({
          url: '/pages/carslist/index',
        })


    },

    toPubCars:function(){
      var that = this;
      var params = {};

      user.checkBind((data) => {
  
        if(data.isbind)
        {
                  
          wx.navigateTo({
            url: '/pages/pubcars/index',
          })

        }else{
  
          wx.navigateTo({
            url: '/pages/bindwx/index',
          })
  
        }
  
        
    },params);
     


    },

    toMyuser:function(){
      var that = this;
        wx.redirectTo({
          url: '/pages/user/index',
        })


    },


    onShow: function () {
     
      var that = this;
      wx.showShareMenu({
        withShareTicket: true,
        menus: ['shareAppMessage', 'shareTimeline']
      })
      if(wx.getStorageSync('isuid'))
      {
          console.log(wx.getStorageSync('isuid'));
        that.data.isuid = wx.getStorageSync('isuid');
      }

      that.setData({
        NewTitle: that.data.NewTitle,
        PriceTitle:that.data.PriceTitle,
        isuid:that.data.isuid,
        isreset:that.data.isreset
      })


      that._loadData();


       



    },

    onPageScroll:function(t){
  //    console.log(t.scrollTop);//会随着用户下滑页面值变大
      var that = this;

      
      if(t.scrollTop <=345)
      {
          that.data.isNew = true;

          that.data.isPrice = true;

          that.setData({isNew: that.data.isNew,isPrice:that.data.isPrice});
      }
        
      that.setData({scrollTop:t.scrollTop});
    },


    
   
    SelectNewItem:function(e){
      var that = this;
      var NewTitle = e.currentTarget.dataset.title;
      that.data.NewTitle = NewTitle;
      that.data.isNew = true;
      that.setData({
        NewTitle:that.data.NewTitle,
        isNew:that.data.isNew
      
      })
    },
    


    toSelectPrice:function(){
      var that = this;
      that.data.scrollTop = 146;
      that.data.isPrice = false;
      that.data.isNew = true;

    


      that.setData({
        isPrice:that.data.isPrice,
        isNew:that.data.isNew,
        scrollTop: that.data.scrollTop
      })
    },

    toCarsType:function(e)
    {
      var special = e.currentTarget.dataset.special
      wx.navigateTo({
        url: '/pages/findcarslist/index?special='+special,
      })

    },

    toFindcarslist:function(e){

    var id = e.currentTarget.dataset.id;
     wx.navigateTo({
       url: '/pages/findcarslist/index?priceid='+id,
     })

    },
    SelectPriceItem:function(e){
      var that = this;
      var PriceTitle = e.currentTarget.dataset.title;
      var btprice = e.currentTarget.dataset.price;
      var brandinfo = wx.getStorageSync('brandinfo');

    


      that.data.PriceTitle = PriceTitle;

      that.data.btprice = btprice;

      that.data.isPrice = true;

      that.data.scrollTop = -1;


      if(brandinfo)
      {
        var params = {btprice:btprice,isuid:that.data.isuid,brandid:brandinfo.brandid,sbrandid:brandinfo.id};

      }else{

        var params = {btprice:btprice,isuid:that.data.isuid,brandid:0,sbrandid:0};
      }



      cars.getCarsListIndex((data) => {
  
     
        that.setData({
          carlen:data.carslist.length,
          carslist:data.carslist
        });
    },params);

    that.data.isreset = false;

      that.setData({
        isreset:that.data.isreset,
        PriceTitle:that.data.PriceTitle,
        isPrice:that.data.isPrice,
        scrollTop:that.data.scrollTop
      
      })
    },
    delBrand:function(){
      var that = this;
      wx.removeStorageSync('brandinfo');
      that.data.brandname = '';

      that.data.brandid = 0;

      that.setData({
        brandname:that.data.brandname   
      })


    var params = {btprice:that.data.btprice,isuid:that.data.isuid,brandid:0};
      

      cars.getCarsListIndex((data) => {
  
     
        that.setData({
          carlen:data.carslist.length,
          carslist:data.carslist
        });
      },params);

      if(that.data.PriceTitle == '价格'&& that.data.brandid == 0 )
      {
          that.data.isreset = true;

        that.setData({
          
          isreset:that.data.isreset 
                });

      }

    },


    delPrice:function(){
      var that = this;
      that.data.btprice = '';

      that.data.PriceTitle = '价格';

      that.setData({
        btprice:that.data.btprice,
        PriceTitle:that.data.PriceTitle
      })

     
    var params = {btprice:that.data.btprice,isuid:that.data.isuid,brandid:that.data.brandid};
      

      cars.getCarsListIndex((data) => {
  
     
        that.setData({
          carlen:data.carslist.length,
          carslist:data.carslist
        });
      },params);

      if(that.data.PriceTitle == '价格'&& that.data.brandid == 0 )
      {
          that.data.isreset = true;

        that.setData({
          
          isreset:that.data.isreset 
                });

      }

    },

    toReset:function()
    {
      var that = this;
      that.data.isNew = true;
      that.data.isPrice = true;
      that.data.NewTitle = '最新上架';
      that.data.PriceTitle = '价格';
      that.data.isuid = 1 ;
      that.data.btprice = '';
      that.data.brandname = '';

      wx.removeStorageSync('brandinfo');

      wx.setStorageSync('isuid', 1);
      that.data.isreset = true;

      that.setData({
        isPrice:that.data.isPrice,
        isNew:that.data.isNew,
        NewTitle:that.data.NewTitle,
        PriceTitle:that.data.PriceTitle,
        isuid:that.data.isuid,
        btprice:that.data.btprice,
        brandname:that.data.brandname,
        isreset:that.data.isreset

   
      })
      that.onShow();

    },


    
    imageLoad: function (e) {
      var imgwidth = e.detail.width,
      imgheight = e.detail.height,
      //宽高比  
      ratio = imgwidth / imgheight;
      var viewHeight = 750 / ratio;
      var imgheight = viewHeight
      var imgheights = this.data.imgheights
      //把每一张图片的高度记录到数组里  
      imgheights.push(imgheight)
      this.setData({
        imgheights: imgheights,
      })
    }, bindchange: function (e) {
      console.log(e.detail.current)
      this.setData({ current: e.detail.current })
    },

    swiperChange: function (e) {

      this.setData({
        swiperCurrent: e.detail.current   //获取当前轮播图片的下标
      })
    },




    goMap: function (e) {
      var that = this;
      var sysinfo = that.data.sysinfo;
      wx.openLocation({
        latitude: parseFloat(sysinfo.lat),
        longitude: parseFloat(sysinfo.lng),
        scale: 18,
        name: sysinfo.companyname,
        address: sysinfo.address
      })
    },

    /*加载所有数据*/
    _loadData:function(callback){
        var that = this;
        var city ;
       city =  wx.getStorageSync('city');


      city = '';
        home.getSysinit(city,(data) => {

          wx.setNavigationBarTitle({
            title: data.sysinfo.name,
          })

          that.data.title = data.sysinfo.name;

          that.data.datainfo = data.datainfo;
          that.data.objectMultiArray = data.list;
    
          that.setData({
            objectMultiArray: data.list,
    
          })


          app.globalData.config = data.uploadInfo;

          that.setData({
              bannerlist: data.bannerlist,
              navlist:data.navlist,
              sysinfo:data.sysinfo,
              isreset:that.data.isreset,
              brandlist:data.brandlist,
              carpricelist:data.carpricelist
          });
          

          that.initpage();
          

      wx.hideNavigationBarLoading(); //完成停止加载
      wx.stopPullDownRefresh();
    
            that.setData({
              isuid:that.data.isuid
            })



      });

    
    },


    initpage:function(){

      var that = this;
      var btprice = that.data.btprice;
      var brandinfo = wx.getStorageSync('brandinfo');

      if(brandinfo)
      {
        var params = {btprice:btprice,isuid:that.data.isuid,brandid:brandinfo.id,provinceid:that.data.provinceid,cityid:that.data.cityid};

      }else{

        var params = {btprice:btprice,isuid:that.data.isuid,brandid:0,provinceid:that.data.provinceid,cityid:that.data.cityid};
      }

    

    cars.getCarsListIndex((data) => {

   
      that.setData({
        carlen:data.carslist.length,
        carslist:data.carslist
      });
  },params);

    },



    bindMultiPickerChange:function(e){

      var that = this;
        console.log(e);
        var value = e.detail.value;
  
          that.data.provinceid = that.data.objectMultiArray[0][value[0]]['id'];
  
        that.data.cityid = that.data.objectMultiArray[1][value[1]]['id'];

        that.data.city = that.data.objectMultiArray[1][value[1]]['name'];

        that.initpage();

        that.setData({
          city:that.data.city,
         })
    },
  
    
  
    bindMultiPickerColumnChange: function (e) {
      var that = this;
      var secondcatelist;
      var data = {
        objectMultiArray: this.data.objectMultiArray,
        multiIndex: this.data.multiIndex
      };
      data.multiIndex[e.detail.column] = e.detail.value;
      var currentdata = this.data.objectMultiArray[e.detail.column][e.detail.value];
      var datainfo = that.data.datainfo;
  
  
  
      if(that.data.provinceid == -1)
        {
          
        that.data.provinceid = that.data.objectMultiArray[0]['id'] ;
  
        }
  
  
  
      switch (e.detail.column) {
        case 0:
          that.data.provinceid = currentdata['id'];
          data.objectMultiArray[1] = datainfo[currentdata['id']]['citylist'];
          
          secondcatelist = data.objectMultiArray[1];
  
          data.multiIndex[1] = 0;
          break;
        case 1:
          that.data.cityid = currentdata['id'];
          break;
      }
     // console.log(data);
  
      that.data.currentdata = data.multiIndex;
  
      this.setData(data);

  
      
    },



    toGetcarslist:function(e) {

      var that = this;

      var id = e.currentTarget.dataset.id;
      that.data.isuid = id;

      var brandinfo = wx.getStorageSync('brandinfo');

      wx.setStorageSync('isuid',that.data.isuid);

      if(brandinfo)
      {
        var params = {isuid:that.data.isuid,brandid:brandinfo.id};

      }else{

        var params = {isuid:that.data.isuid,brandid:0};
      }

    cars.getCarsListIndex((data) => {

   
      that.setData({

        carlen:data.carslist.length,
        carslist:data.carslist
      });
  },params);
      

        that.setData({
          isuid:that.data.isuid
        })




      
    },


    toCarsDetail:function(e){

      var that = this;
      var id = e.currentTarget.dataset.id;
      
      wx.navigateTo({
         url: "/pages/carsdetail/index?id=" + id
        })
    

  
    },

    selectBrand:function(e){
      var that = this;
      var id = e.currentTarget.dataset.id;

      wx.navigateTo({
        url: "/pages/findcarslist/index?brandid="+id 
       })


    },

    toSelectCars:function(){

      var that = this;
  
        wx.navigateTo({
          url: "/pages/searchcars/index"
        })

  
    },



    

    toLogin: function (e) {


      var that = this;
      var params = {};

      wx.switchTab({
        url: "/pages/user/index"
      })


  
    },
    

    toArticle: function (e) {

        var that = this;
        wx.navigateTo({
          url: "/pages/article/index"
        })
  
    }
    ,



    toInnerUrl: function (e) {


      var url = e.detail.value.innerurl;
      wx.navigateTo({
        url: url
      })
  
    },
  
    toMenuUrl: function (e) {
  
      var url = e.detail.value.innerurl;
      wx.switchTab({
        url: url
      })
  
    },
  

    /*下拉刷新页面*/
    onPullDownRefresh: function(){
      wx.showNavigationBarLoading();
      this.onShow();
    },

    //分享效果
    onShareAppMessage: function () {
       var that = this;
        return {
            title: that.data.title,
            path: '/pages/index/index'
        }
    }

})


