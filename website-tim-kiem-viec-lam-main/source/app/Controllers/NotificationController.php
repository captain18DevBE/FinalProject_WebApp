<?php
require_once("./app/Models/NotificationModel.php");

class NotificationController
{
    private $model;
    public function __construct()
    {
        $this->model = new NotificationModel();
    }

    public function getAll($email)
    {
        $this->model->getAll($email);
        $jsonData = file_get_contents('notification.json');
        return json_decode($jsonData, true);
    }

    public function getDetailNotification($idNotification)
    {
        return $this->model->getDetailNotification($idNotification);
    }

    public function getAmountNotRead($email)
    {
        $amount = $this->model->getAmountNotRead($email);
        return $amount;
    }

    public function createNotificationAccept($email, $idCompany)
    {
        $title = "Thông báo chấp nhận hồ sơ ứng tuyển";
        $content = "Chúng tôi rất vui mừng thông báo rằng hiện tại chúng tôi đang tiếp nhận hồ sơ ứng tuyển cho các vị trí tuyển dụng trong tổ chức của chúng tôi. Chúng tôi chào đón ứng viên đến từ nhiều nền tảng khác nhau và khuyến khích tất cả các cá nhân quan tâm và đủ điều kiện nộp đơn.
            Để nộp đơn của bạn, vui lòng làm theo hướng dẫn được cung cấp trong thông tin công việc hoặc trên trang web của chúng tôi. Hãy đảm bảo bao gồm một bản sơ yếu lý lịch/CV tập trung vào các kỹ năng, kinh nghiệm và trình độ chuyên môn liên quan đến vị trí bạn đang ứng tuyển.

            Đội ngũ của chúng tôi sẽ cẩn thận xem xét tất cả các đơn ứng tuyển và chọn ra các ứng viên phù hợp nhất với yêu cầu của vị trí. Nếu bạn được chọn để phỏng vấn, chúng tôi sẽ liên hệ trực tiếp với bạn để lên lịch.

            Chúng tôi coi trọng tính đa dạng và tính bao dung trong môi trường làm việc của chúng tôi và cam kết cung cấp cơ hội việc làm bình đẳng cho tất cả các cá nhân, bất kể chủng tộc, giới tính, tuổi tác, tôn giáo, địa chỉ, hoặc bất kỳ đặc điểm nào khác được bảo vệ bởi pháp luật.

            Cảm ơn bạn đã quan tâm đến việc tham gia cùng đội ngũ của chúng tôi. Chúng tôi mong đợi để xem xét đơn của bạn.";
        $postDate = date("Y-m-d");

        $this->model->createNotification($email, $idCompany, $title, $content, $postDate);
    }

    public function createNotificationRefuse($email, $idCompany)
    {
        $title = "Thông báo từ chối hồ sơ ứng tuyển";
        $content = "Chúng tôi rất tiếc thông báo rằng hiện tại chúng tôi không thể tiếp tục xử lý đơn ứng tuyển của bạn. Mặc dù chúng tôi đánh giá cao sự quan tâm của bạn đến tổ chức của chúng tôi và thời gian cũng như nỗ lực mà bạn đã bỏ ra để nộp đơn, nhưng chúng tôi đã quyết định tìm kiếm các ứng viên khác có trình độ phù hợp hơn với yêu cầu của vị trí tuyển dụng. 
            Vui lòng lưu ý rằng quyết định của chúng tôi không phản ánh năng lực hay trình độ của bạn, và chúng tôi khuyến khích bạn tiếp tục tìm kiếm cơ hội phù hợp với mục tiêu nghề nghiệp và sở thích của bạn.
        
            Chúng tôi cảm ơn sự quan tâm của bạn đến việc trở thành nhà tuyển dụng tiềm năng của chúng tôi và chúc bạn may mắn trong các hoạt động của tương lai.
        
            Trân trọng";
        $postDate = date("Y-m-d");

        $this->model->createNotification($email, $idCompany, $title, $content, $postDate);
    }

    public function createNotificationApply($email, $idCompany)
    {
        $title = "Thông báo về việc tiếp nhận hồ sơ ứng tuyển từ người tìm việc";
        $content = "Chúng tôi rất vui mừng thông báo rằng hiện tại chúng tôi đang tiếp nhận hồ sơ ứng tuyển cho các vị trí tuyển dụng trong tổ chức của chúng tôi. Chúng tôi chào đón tất cả các ứng viên quan tâm và đủ điều kiện để nộp đơn cho các vị trí tuyển dụng hiện có.

            Để nộp đơn của bạn, vui lòng làm theo hướng dẫn được cung cấp trong thông tin công việc hoặc trên trang web của chúng tôi. Hãy đảm bảo bao gồm một bản sơ yếu lý lịch/CV tốt, tập trung vào các kỹ năng, kinh nghiệm và trình độ chuyên môn liên quan đến vị trí bạn đang ứng tuyển.
        
            Đội ngũ của chúng tôi sẽ cẩn thận xem xét tất cả các đơn ứng tuyển và chọn ra các ứng viên phù hợp nhất với yêu cầu của vị trí. Nếu bạn được chọn để phỏng vấn, chúng tôi sẽ liên hệ trực tiếp với bạn để lên lịch thời gian và ngày.
        
            Chúng tôi khuyến khích ứng viên đến từ nhiều nền tảng khác nhau tham gia ứng tuyển và coi trọng tính bao dung trong môi trường làm việc của chúng tôi. Chúng tôi cam kết cung cấp cơ hội việc làm bình đẳng cho tất cả các cá nhân, bất kể chủng tộc, giới tính, tuổi tác, tôn giáo, địa chỉ, hoặc bất kỳ đặc điểm nào khác được bảo vệ bởi pháp luật.
        
            Cảm ơn bạn đã quan tâm đến việc tham gia cùng đội ngũ của chúng tôi. Chúng tôi mong đợi được xem xét đơn của bạn.
        
            Trân trọng.";
        $postDate = date("Y-m-d");

        $this->model->createNotification($email, $idCompany, $title, $content, $postDate);
    }

    public function createNotificationChangePassword($email)
    {
        $title = "Thông báo về việc thay đổi mật khẩu";
        $content = "Gửi [Người dùng],

            Chúng tôi được thông báo rằng mật khẩu của bạn đã được thay đổi thành công. Đây là một email xác nhận để thông báo rằng tài khoản của bạn bây giờ đã được bảo mật với mật khẩu mới của bạn.

            Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng liên hệ ngay với đội hỗ trợ khách hàng của chúng tôi để báo cáo bất kỳ hoạt động trái phép nào.

            Để đảm bảo an toàn cho tài khoản của bạn, chúng tôi khuyên bạn nên giữ mật khẩu của mình bí mật và tránh chia sẻ nó với bất kỳ ai. Ngoài ra, việc cập nhật mật khẩu thường xuyên là một thói quen tốt để ngăn chặn bất kỳ truy cập trái phép nào vào tài khoản của bạn.

            Cảm ơn bạn đã hợp tác trong việc duy trì an toàn cho tài khoản của bạn.

            Trân trọng.";
        $postDate = date("Y-m-d");

        $this->model->createNotification($email, 0, $title, $content, $postDate);
    }

    public function readNotification($email, $idNotification)
    {
        $this->model->readNotification($email, $idNotification);
    }
}

class NotificationInfo
{
    public $idNotification;
    public $idUser;
    public $title;
    public $content;
    public $idCompany;
    public $postDate;

    public function __construct($idUser, $title, $content, $idCompany, $postDate)
    {
        $this->idUser = $idUser;
        $this->title = $title;
        $this->content = $content;
        $this->idCompany = $idCompany;
        $this->postDate = $postDate;
    }
}
