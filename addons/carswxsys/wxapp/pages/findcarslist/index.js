
import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();

Page({
    data: {
  

        imgheights: [],
        //图片宽度  
        imgwidth: 750,
        //默认  
        current: 0 ,
        swiperCurrent: 0,
        loadingHidden: false,
        scrollTop:-1,
        priceid:0,
        brandid:0,
        carlen:0,
        special:''
    }, 
    
    

    onPageScroll:function(t){
      console.log(t.scrollTop);//会随着用户下滑页面值变大
      var that = this;

      
      if(t.scrollTop <=145)
      {
          that.data.isNew = true;

          that.data.isPrice = true;

          that.setData({isNew: that.data.isNew,isPrice:that.data.isPrice});
      }
        
      that.setData({scrollTop:t.scrollTop});
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

 

    onLoad: function (e) {
     
     
      var that = this;
      wx.showShareMenu({
        withShareTicket: true,
        menus: ['shareAppMessage', 'shareTimeline']
      })

      wx.setNavigationBarTitle({
        title: '车辆筛选',
      })
       
      if(e)
      {
          if (e.hasOwnProperty("priceid"))
          {
            that.data.priceid = e.priceid;
          }

          if (e.hasOwnProperty("brandid"))
          {
            that.data.brandid = e.brandid;
          }

          if (e.hasOwnProperty("special"))
          {
            that.data.special = e.special;
          }
          

        }

      that._loadData();

       



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
        var params = {priceid:that.data.priceid,brandid:that.data.brandid,special:that.data.special};
      

    cars.getSelectCars((data) => {

   
      that.setData({

        carslist:data.carslist,
        brandinfo:data.brandinfo,
        priceinfo:data.priceinfo,
        brandid:that.data.brandid,
        priceid:that.data.priceid,
        special:that.data.special
      });
  },params);

      

    
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
            path: '/pages/carslist/index'
        }
    }

})


