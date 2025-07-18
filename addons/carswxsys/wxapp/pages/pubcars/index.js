import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();



import { User } from '../../model/user-model.js';

var user  = new User();

import { Token } from '../../utils/token.js';

var token = new Token();

var app = getApp();

Page({

  /**
   * 页面的初始数据
   */
  data: {

    index: 0,
    multiIndex: [0, 0, 0],
    objectMultiArray: [],
    datainfo: '',
    firstid: -1,
    currentdata:0,
    rectname:'',


    logoimglist:[],
    imagelist:[],
    cardimglist:[],
    companyimglist:[],
    arealist:[],
    areaidindex:-1,
    areaid:0,
    cityid:0,
    provinceid:0,

    lat:0,
    lng:0,
    per:'',
 
    isagree:0,
    show1:'none',
    show2:'none',
    show3:'none',

    cartype: ['客车', '货车', '三厢车', '两厢车', '旅行车', '皮卡', 'MPV', 'SUV', '掀背车', '软顶敞篷车', '硬顶敞篷车','硬顶跑车'],
    cartypeindex: -1,
    cartypename: '',

    carchange: ['自动档', '手动档'],
    carchangeindex: -1,
    carchangename: '',
    

    carrate: ['国一', '国二', '国三', '国四', '国五', '国六', '欧一', '欧二', '欧三', '欧四', '欧五','欧六'],
    carrateindex: -1,
    carratename: '',

    carcolor: ['银灰色', '深灰', '黑色', '白色', '红色', '蓝色', '咖啡色', '香槟色', '黄色', '紫色', '绿色','橙色','粉红色','棕色','冰川白','银色','金色','其他'],
    carcolorindex: -1,
    carcolorname: '',

    carfuel: ['汽油', '柴油', '油电混合', '增程式', '插电式混合动力', '纯电力', '氢燃料电池', '汽油+48V轻混系统', '油气混合'],
    carfuelindex: -1,
    carfuelname: '',


    carpos: ['2座', '4座','5座','6座','7座及以上'],
    carposindex: -1,
    carposname: '',



    brandid:0,
    sbrandid:0,
    carnumdate:'',

    carkmtitle:'请输入公里数',
    brandinfo:[],



  },
  radioChange: function (e) {
    this.data.per = e.detail.value;
  },
  getPhoneNumber: function (e) {
    var that = this;


  token.getTokenPhoneNumFromServer((data)=>{


    if (e.detail.errMsg == 'getPhoneNumber:fail user deny') {
      wx.showModal({
        title: '提示',
        showCancel: false,
        content: '未授权',
        success: function (res) { }
      }) 
    } else { 
    
      var params = {iv: e.detail.iv, encryptedData: e.detail.encryptedData};
      user.getPhone((data) => {

        that.data.istel= true;
        that.setData({
          istel:that.data.istel,
          tel:data.tel
        });

          },params);



    }



  }


  )


  
  },


  bindMultiPickerChange:function(e){

    var that = this;
   var value = e.detail.value;
    console.log(value);
    console.log(this.data.objectMultiArray);
    console.log(this.data.objectMultiArray[1][value[1]]['name']);

    var areaname = this.data.objectMultiArray[2][value[2]]['name'];
    var cityname = this.data.objectMultiArray[1][value[1]]['name'];
    var provincename = this.data.objectMultiArray[0][value[0]]['name'];
    that.data.rectname = provincename+'/'+cityname+'/'+areaname;
    that.setData({
      rectname:that.data.rectname,
    })



    that.data.provinceid = this.data.objectMultiArray[0][value[0]]['id'];
    that.data.cityid = this.data.objectMultiArray[1][value[1]]['id'];
    that.data.areaid = this.data.objectMultiArray[2][value[2]]['id'];


  },


  bindMultiPickerColumnChange: function (e) {
    var that = this;
    var citylist;
    var data = {
      objectMultiArray: this.data.objectMultiArray,
      multiIndex: this.data.multiIndex
    };
    data.multiIndex[e.detail.column] = e.detail.value;
    var currentdata = this.data.objectMultiArray[e.detail.column][e.detail.value];
    var datainfo = that.data.datainfo;
    console.log(currentdata);

    if(that.data.firstid == -1)
      {
        
      that.data.firstid = that.data.objectMultiArray[0][0]['id'] ;

      }


    console.log(datainfo);
    switch (e.detail.column) {
      case 0:
        that.data.firstid = currentdata['id'];
        data.objectMultiArray[1] = datainfo[currentdata['id']]['citylist'];
        
        citylist = data.objectMultiArray[1];
  
       
        data.objectMultiArray[2] = datainfo[currentdata['id']][citylist[0]['id']]['arealist'];
        
        data.multiIndex[1] = 0;
        data.multiIndex[2] = 0;
        break;
      case 1:
       // that.data.firstid = currentdata['id'];
      //  console.log(datainfo[that.data.firstid][currentdata['id']]['housenumlist']);

        data.objectMultiArray[2] = datainfo[that.data.firstid][currentdata['id']]['arealist'];
        data.multiIndex[2] = 0;
        break;
    }
   // console.log(data);

    that.data.currentdata = data.multiIndex;


    /*
   that.data.area =  data.objectMultiArray[2][data.multiIndex[2]]['name'];


    that.setData({
      area:that.data.area,
    })

    */

    this.setData(data);

    
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    var that = this;
    that.data.id =options.id;
    wx.setNavigationBarTitle({
      title: '发布二手车' ,
    })

    console.log(app.globalData.config.storage);
  
    if(that.data.cityid ==0 )
    {
      that.data.rectname = '请选择区域';
    }

    that.setData({
      rectname: that.data.rectname
   
    })
    
    that.initpage();


  },

  initpage:function(){

    var that = this;

    var params = {};

    cars.getPubInit((data) => {

      that.data.datainfo = data.datainfo;
      that.data.objectMultiArray = data.list;

      that.setData({
        objectMultiArray: data.list,

      })


    })
    

  },

  bindAreaChange: function (e) {
    var arealist = this.data.arealist;

    if (arealist) {
      this.data.areaid = arealist[e.detail.value].id;
      this.data.areaidindex = e.detail.value;
    }
    this.setData({
      arealist: arealist,
      areaidindex: e.detail.value
    })
  }
  ,

  toSelectBrand:function(){

    var that = this;

      wx.navigateTo({
        url: "/pages/selectbrand/index?id=4"
      })


  },

  goHousexy:function(){

    wx.navigateTo({
      url: "/pages/xypub/index?id=4"
    })

  },

  bindCarChange: function (e) {
    var carchange = this.data.carchange;

    if (carchange) {
      this.data.carchangeindex = e.detail.value;
      this.data.carchangename = carchange[e.detail.value];
    }
    this.setData({
      carchange: carchange,
      carchangeindex: e.detail.value
    })
  },

  bindCarrate: function (e) {
    var carrate = this.data.carrate;

    if (carrate) {
      this.data.carrateindex = e.detail.value;
      this.data.carratename = carrate[e.detail.value];
    }
    this.setData({
      carrate: carrate,
      carrateindex: e.detail.value
    })
  },

  bindCartype: function (e) {
    var cartype = this.data.cartype;

    if (cartype) {
      this.data.cartypeindex = e.detail.value;
      this.data.cartypename = cartype[e.detail.value];
    }
    this.setData({
      cartype: cartype,
      cartypeindex: e.detail.value
    })
  },


  bindCarfuel: function (e) {
    var carfuel = this.data.carfuel;

    if (carfuel) {
      this.data.carfuelindex = e.detail.value;
      this.data.carfuelname = carfuel[e.detail.value];
    }
    this.setData({
      carfuel: carfuel,
      carfuelindex: e.detail.value
    })
  },
  bindPosChange: function (e) {
    var carpos = this.data.carpos;

    if (carpos) {
      this.data.carposindex = e.detail.value;
      this.data.carposname = carpos[e.detail.value];
    }
    this.setData({
      carpos: carpos,
      carposindex: e.detail.value
    })
  },


  bindCarcolorChange: function (e) {
    var carcolor = this.data.carcolor;

    if (carcolor) {
      this.data.carcolorindex = e.detail.value;
      this.data.carcolorname = carcolor[e.detail.value];
    }
    this.setData({
      carcolor: carcolor,
      carcolorindex: e.detail.value
    })
  },


  bindDateChange: function(e) {
    var that = this;
    that.data.carnumdate = e.detail.value;
    this.setData({
      carnumdate: e.detail.value
    })
  },
  
  

  getpostion:function(){
    var that = this;
    wx.chooseLocation({
      success: function (res) {
        that.data.lat = res.latitude;
        that.data.lng = res.longitude;
        that.setData({
          address: res.name
        })
      },
      fail: function (res) {
        // fail
        console.log(res);
      },
      complete: function () {
        // complete
      }
    })

  },



  savepubinfo:function(e){

 
    var that = this;

    console.log(that.data.logoimglist);
    console.log(that.data.imagelist);

   if (that.data.isagree == 0) {
     wx.showModal({
       title: '提示',
       content: '请先同意发布协议',
       showCancel: false,
       success: function (res) {
 
 
       }
     })
     return
   }
 
 
     var title = e.detail.value.title;

     var money = e.detail.value.money;
     var carage = e.detail.value.carage;
     var tel = e.detail.value.tel;
     var carkm = e.detail.value.carkm;
     var carnumdate = that.data.carnumdate;
     var carrate = that.data.carratename;
     var cartype = that.data.cartypename;
     var carchange = that.data.carchangename;
     var carpl = e.detail.value.carpl;
     var carfuel = that.data.carfuelname;
     var per = that.data.per;

     var carpos = that.data.carposname;

     var carcolor = that.data.carcolorname;

     var content = e.detail.value.content;
     var provinceid = that.data.provinceid;
     var cityid = that.data.cityid;
     var areaid = that.data.areaid;

     var brandid = that.data.brandid;


     if(brandid == 0 )
     {
     wx.showModal({
       title: '提示',
       content: '请选择品牌',
       showCancel: false
     })
     return

     }
    
     if(areaid == 0 )
       {
       wx.showModal({
         title: '提示',
         content: '请选择区域',
         showCancel: false
       })
       return
 
       }
      
     

     if (title == "") {
       wx.showModal({
         title: '提示',
         content: '请输入标题',
         showCancel: false
       })
       return
     }

     if (tel == "") {
      wx.showModal({
        title: '提示',
        content: '请获取手机号',
        showCancel: false
      })
      return
    }
  
   
    

    if (money == "") {
      wx.showModal({
        title: '提示',
        content: '请输入售价',
        showCancel: false
      })
      return
    }
 

    if (carage == "") {
      wx.showModal({
        title: '提示',
        content: '请输入车龄',
        showCancel: false
      })
      return
    }
   

    if (carkm == "") {
      wx.showModal({
        title: '提示',
        content: '请输入公里数',
        showCancel: false
      })
      return
    }

    if(carnumdate == '')
    {
      wx.showModal({
        title: '提示',
        content: '请选择初次上牌日期',
        showCancel: false
      })
      return

    }

    if (cartype == "") {
      wx.showModal({
        title: '提示',
        content: '请选择车身结构',
        showCancel: false
      })
      return
    }

    if (carrate == "") {
      wx.showModal({
        title: '提示',
        content: '请输入排放',
        showCancel: false
      })
      return
    }

    if (carchange == "") {
      wx.showModal({
        title: '提示',
        content: '请选择变速箱',
        showCancel: false
      })
      return
    }

    if (carpl == "") {
      wx.showModal({
        title: '提示',
        content: '请输入排量',
        showCancel: false
      })
      return
    }

    if (per == "") {
      wx.showModal({
        title: '提示',
        content: '请输入排量单位',
        showCancel: false
      })
      return
    }

    if (carfuel == "") {
      wx.showModal({
        title: '提示',
        content: '请选择燃料类型',
        showCancel: false
      })
      return
    }

    if (carpos == "") {
      wx.showModal({
        title: '提示',
        content: '请选择座位',
        showCancel: false
      })
      return
    }
  

    if (carcolor == "") {
      wx.showModal({
        title: '提示',
        content: '请选择颜色',
        showCancel: false
      })
      return
    }

   
    
  
    var logoimglist = that.data.logoimglist;
    var thumb_url = that.data.imagelist.join(',');



 
    var cityinfo = wx.getStorageSync('cityinfo');
     
     var params = {
                provinceid:provinceid,
                areaid:areaid,
                cityid:cityid,
                brandid: brandid,
                sbrandid:that.data.sbrandid,
                title:title,
                money:money,
                carage:carage,
                cartype:cartype,
                carkm:carkm,
                carnumdate:carnumdate,
                carrate:carrate,
                carchange:carchange,
                carspl:carpl,
                per:per,
                carfuel:carfuel,
                tel:tel,
                carpos:carpos,
                carcolor:carcolor,
                content: content,
                thumb: logoimglist[0],
                thumb_url:thumb_url
           
                             };

 
       cars.Savecars((data) => {



        if(data.status == 0 )
        {
        
            wx.showToast({
              title: '发布成功',
              icon: 'succes',
              duration: 1000,
              mask:true,
              success:function() {
              
                wx.redirectTo({
                  url: "/pages/mypubs/index"
                })
              }
          })   
    }else{

      wx.showModal({
        title: '提示',
        content: data.msg,
        showCancel: false
      })
      return
    }
  

                              
                          },params);
 

 
   },


   doagree: function (e) {
    var isagree = e.detail.value;



    if (isagree.length > 0) {
      this.data.isagree = isagree[0];
    } else {

      this.data.isagree = 0;
    }

    //


    console.log(this.data.isagree);

  },

  deleteImg1:function(e){
    var that = this;
    var index = e.currentTarget.dataset.index;

    that.data.logoimglist = [];

    that.setData({
      imgs1: [],
      show1: 'none'
    });


    console.log(index);

  },

  deleteImg2:function(e){

    var that = this;
    var index = e.currentTarget.dataset.index;

    var imagelist = [];
    var imgs2 = [];

    console.log(that.data.imagelist);
    console.log(that.data.imgs2);



    for(var i = 0 ; i < that.data.imagelist.length ; i++ )
    {

      if(i != index)
      {
          imagelist.push(that.data.imagelist[i]);
          imgs2.push(that.data.imgs2[i]);

      }

    }

    that.data.imagelist = imagelist;
    that.data.imgs2 = imgs2;
    that.setData({
      imgs2: imgs2,
     // show2: 'none'
    });

    if(that.data.imagelist.length == 0)
    {

      that.setData({
        show2: 'none'
      });

    }




    console.log(index);

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

   var that = this;
   if(wx.getStorageSync('brandinfo'))
   {

  

    var brandinfo = wx.getStorageSync('brandinfo');

    console.log(brandinfo);
    that.data.brandid = brandinfo.brandid;
    that.data.sbrandid = brandinfo.sbrandid;
   }
  
   that.setData({
    brandid:that.data.brandid,
    brandinfo: wx.getStorageSync('brandinfo')
  });


  token.getTokenPhoneNumFromServer((data)=>{
    
  })

  },



  chooseImg: function (e) {
    var that = this;
   
    var count = 9;
    var id = parseInt(e.currentTarget.dataset.id);
    if(id ==1 )
    {
        count = 1;

    }


    wx.chooseImage({
      count: count, // 默认9
      sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        // 返回选定照片的本地文件路径列表，tempFilePath可以作为img标签的src属性显示图片
        


        var tempFilePaths = res.tempFilePaths;

        var imgs = [];
  
         
        if(id == 1)
        {
          that.data.logoimglist = [];
          that.setData({
            imgs1: tempFilePaths,
            show1: 'block'
          });
        }else if(id == 2){
          that.data.imagelist = [];
          that.data.imgs2 = tempFilePaths;
          that.setData({
            imgs2: tempFilePaths,
            show2: 'block'
          });
        }
  
  
  
       // var tempFilePaths = that.data.imgs
  
        for (var s = 0; s < tempFilePaths.length; s++) {
  
          console.log(tempFilePaths[s]);
  
          that.uploadimg(tempFilePaths[s],id);
        }




      },
      fail: function (res) {
      },
      complete: function (res) {
      }
    });
  },

  uploadimg: function (path,id) {
    //var uploadurl = app.util.geturl({ 'url': 'entry/wxapp/upload' });
    // var id = id;
    wx.showToast({
      icon: "loading",
      title: "正在上传"
    });

    var that = this;

     var params ={

      path:path

     }
    cars.uploadimg((data) => {

      console.log(data);



      if(id == 1)
      {

        if(app.globalData.config.storage == 'local')
        {
          that.data.logoimglist.push(data.imgpath);
        }else if(app.globalData.config.storage == 'alioss'){

          that.data.logoimglist.push(data.data.url);
        }

      }else if(id == 2){
        if(app.globalData.config.storage == 'local')
        {
         that.data.imagelist.push(data.imgpath);
        }else if(app.globalData.config.storage == 'alioss'){

          that.data.imagelist.push(data.data.url);
        }

      }


                            
                        },params);






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