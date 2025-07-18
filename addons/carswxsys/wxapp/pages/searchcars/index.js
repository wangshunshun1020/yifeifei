import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();

Page({
  data: {
 
    TabCur: 1,
    MainCur: 0,
    VerticalNavTop: 0,
    list: [],
    load: true,
    cateid:0,
    priceid:0,
    edu:'',
    express:'',
    sex:-1,
    special:'',
    loadmore:true,
    id:0

  },
  onLoad() {
    var that = this;
    wx.setNavigationBarTitle({
      title: '车源筛选',
    })
    
    wx.showLoading({
      title: '加载中...',
      mask: true
    });
  






  },

  toCarsDetail:function(e){

    var that = this;
    var id = e.currentTarget.dataset.id;
    
    wx.navigateTo({
       url: "/pages/carsdetail/index?id=" + id
      })
  


  },


  bindSave: function (e) {
    var that = this;
    var keyword = e.detail.value.keyword;

    if (keyword == "") {
      wx.showModal({
        title: '提示',
        content: '请输入相关信息',
        showCancel: false
      })
      return
    }


    var params = {keyword:keyword};
    cars.getSelectCars((data) => {

      if(data.carslist.length>0)
      {
      that.setData({
        carslist:data.carslist,
        loadmore:true
      }); 
    }else{
      that.setData({
        carslist:data.carslist,
        loadmore:false
      }); 
      
    }

    },params)

  },
  onReady() {
    wx.hideLoading()
  }
})