import { City } from '../../model/city-model.js';
var city  = new City();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    scrollHeight: '',
		toView: '#',
    type:0
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {

    var that = this;
    that.data.type = e.id;
    wx.setNavigationBarTitle({
      title: '切换城市',
    })

    var params = {};

    city.GetCityList((data) => {

      var citylist = data.citylist;
      that.setData({
        hotlist:data.hotlist,
        citylist:data.citylist
      });
  },params);


  },

  selectcity:function(e){

    var that = this;
    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;
  var cityinfo={};
    cityinfo.name = name;
    cityinfo.id = id;

    console.log(cityinfo);
    wx.setStorageSync('cityinfo', cityinfo);

  if(that.data.type == 1)
    {
        wx.switchTab({
          url: "/pages/findjob/index"
        })
    }else if(that.data.type == 2)
    {
    wx.switchTab({
      url: "/pages/findworker/index"
    })

  } else if (that.data.type == 0) {
    wx.switchTab({
      url: "/pages/index/index"
    })

  } else if (that.data.type == 3) {
    wx.navigateTo({
      url: "/pages/companylist/index"
    })

  }  else if (that.data.type == 4) {
    wx.navigateTo({
      url: "/pages/typejoblist/index"
    })

  }else if(that.data.type == 5){

    wx.navigateTo({
      url: "/pages/companyregister/index"
    })

    
  }


  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})