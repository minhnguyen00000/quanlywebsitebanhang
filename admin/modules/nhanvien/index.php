<script type="text/javascript">
function deleteCat(id)
{
  an=confirm("Bạn có chắc muốn xóa?");
  if(an)
  {
    location.href="index.php?mod=nhanvien&ac=xoa&id="+id;
  }
  
}
</script>
<div class="row">
            <div class="col-md-12">
              <div class="card card-table">
               
                <div class="card-header">
                   <div class="row">
                  <div class="col-md-9">
                  <h1 class="page-header">
                    Quản lý nhân viên
                    <a href="index.php?mod=nhanvien&ac=them" class="btn btn-danger">Thêm Mới</a>
                  </h1>
                </div>



                  <form class="form-inline my-2 my-lg-0 mr-lg-2" action="" method="post">
                  <div class="input-group">
                    

                    <input  type="text" id="timkiemf" name="timkiemt" placeholder="Tìm kiếm...">
                        <input type="submit" value="Tìm kiếm" id="timkiembtn" name="timkiem">
                  </div>
                </form>
                
              </div>
            </div>



                </div>
                <div class="card-body table-responsive">
                  <table class="table table-striped table-borderless">
                    <thead>
                      <tr>
                        <th style="width:5%;">Mã</th>                       
                        
                        <th style="width:5%;">Tên</th>

                        <th style="width:5%;">Tài khoản</th>                       
                        
                        <th style="width:5%;">Mật khẩu</th>

                        <th style="width:5%;">Địa chỉ</th>                       
                        
                        <th style="width:5%;">SĐT</th>

                        <th style="width:5%;">Email</th>                       
                        
                        <th style="width:5%;">Ngày đăng ký</th>
                        
                        <th style="width:5%;">Trạng thái</th>

                                  
                                           
                        
                        <th style="width:10%;" class="actions">Quản lý</th>

                      </tr>
                    </thead>
                    <tbody class="no-border-x">
                    <?php 

                      

                      $sql="select * from nhanvien";
                      $stmt=$pdo->prepare($sql);
                      $stmt->execute();
                      // dem so sp
                      $sousers=$stmt->rowCount();                   
                      $page=1;
                      if(isset($_GET['page']))
                        $page=$_GET['page'];
                      $bd=($page-1)*$so1trang;
                      if(isset($_GET['manhanvien']))
                      {
                        
                        $sql="select * from nhanvien where manhanvien=:ma limit $bd,$so1trang";
                        $stmt=$pdo->prepare($sql);
                        $stmt->bindParam('ma',$manhanvien);
                        $manhanvien=$_GET['manhanvien'];
                        }else
                        {
                          $sql="select * from nhanvien order by manhanvien desc limit $bd,$so1trang";
                          $stmt=$pdo->prepare($sql);
                        }
                        
                        $stmt->execute();



                      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                      {

                    ?>                   
                      <tr>
                        <td><?php echo $row['manhanvien']; ?></td>

                        <td><?php echo $row['tennhanvien']; ?></td>

                        <td><?php echo $row['taikhoan']; ?></td>

                        <td><?php echo $row['matkhau']; ?></td>

                        <td><?php echo $row['diachi']; ?></td>

                        <td><?php echo $row['sodienthoai']; ?></td>
                        

                        <td><?php echo $row['email']; ?></td>

                        <td><?php echo $row['ngaytao']; ?></td>

                        <td>
                          <?php if ($row['tinhtrang'] == 0): ?>
                            <button  class="btn btn-xs btn-warning">Đang hoạt động</button>
                          <?php endif ?>
                          <?php if ($row['tinhtrang'] == 1): ?>
                            <button class="btn btn-xs btn-success">Đang khóa</button>
                          <?php endif ?>
                           
                        </td>
                        

                        
                        <td>
                          <a class="btn btn-primary" href="index.php?mod=nhanvien&ac=sua&id=<?php echo $row['manhanvien']; ?>"">Sửa</a>
                          <a class="btn btn-danger" href="#" onclick="deleteCat('<?php echo $row['manhanvien']; ?>')">Xóa</a>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>


                  </table>


                 <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <?php
                      $sotrang=ceil($sousers/$so1trang);
                      if($sotrang>1)
                      {
                        for($i=1;$i<=$sotrang;$i++)
                        if(isset($manhanvien))
                        {
                          if($page==$i)
                            echo '<li class="page-item"><a class="page-link">'.$i.'</a></li>';
                          else  
                            echo '<li class="page-item"><a class="page-link" href="index.php?mod=nhanvien&manhanvien='.$manhanvien.'&page='.$i.'">'.$i.'</a></li>';

                        }
                        else
                        {
                          if($page==$i)
                            echo '<li class="page-item"><a class="page-link">'.$i.'</a></li>';
                          else
                          echo '<li class="page-item"><a class="page-link" href="index.php?mod=nhanvien&page='.$i.'">'.$i.'</a></li>';
                        
                        }
                        
                      
                      }
                      ?>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>