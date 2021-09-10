 <footer>
     <div class="container-fluid p-0 footer-container">
         <div class="row">
             <div class="col-6 footer-left">
                 <div class="logo-and-text">
                     <div class="footer-image">
                         <img src="{{ asset('images/hapo_learn_white1.png') }}" alt="HapoLearnLogo">
                     </div>
                     <p class="footer-text">Interactive lessons, "on-the-go"<br>practice, peer support.</p>
                 </div>
                 <ul class="left-footer-menu">
                     <li>
                         <a href="{{ route('home') }}" class="left-footer-link">Home</a>
                     </li>
                     <li>
                         <a href="#" class="left-footer-link">Features</a>
                     </li>
                     <li>
                         <a href="{{ route('courses') }}" class="left-footer-link">Courses</a>
                     </li>
                     <li>
                         <a href="#" class="left-footer-link">Blog</a>
                     </li>
                 </ul>
             </div>
             <div class="col-6 footer-right">
                 <ul class="right-footer-menu">
                     <li>
                         <a href="#" class="right-footer-link">Contact</a>
                     </li>
                     <li>
                         <a href="#" class="right-footer-link">Terms of Use</a>
                     </li>
                     <li>
                         <a href="#" class="right-footer-link">FAQ</a>
                     </li>
                 </ul>
                 <ul class="right-footer-icons">
                     <li>
                         <a href="#" class="right-footer-icon" target="_blank" data-toggle="tooltip" data-placement="bottom" title="facebook.com/tuyen.dung.haposoft"><img src="{{ asset('./images/facebook.png') }}" alt="facebook-icon" class="icon-img"></a>
                     </li>
                     <li>
                         <a href="#" class="right-footer-icon" data-toggle="tooltip" data-placement="bottom" title="+84-85-645-9898"><img src="{{ asset('./images/phone.png') }}" alt="phone-icon" class="icon-img"></a>
                     </li>
                     <li>
                         <a href="#" class="right-footer-icon" data-toggle="tooltip" data-placement="bottom" title="info@haposoft.com"><img src="{{ asset('./images/email.png') }}" alt="email-icon" class="icon-img"></a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
     <div class="copy-right">
         <p class="copy-right-text"> © 2020 HapoLearn, Inc. All rights reserved.</p>
     </div>
 </footer>

 <div class="messenger-chat">
     <div class="chat-button"><img src="{{ asset('images/messenger_icon.png') }}" alt="messenger" class="button-img"></div>
     <div class="chat-content">
         <div class="cancel-button">
             <i class="fas fa-times"></i>
         </div>
         <div class="hapo-chatbot">
             <div class="chatbot-avatar"></div>
             <div class="chatbot-message">
                 <p class="chatbot-name">HapoLearn</p>
                 <p class="message-content">HapoLearn xin chào bạn.<br>Bạn có cần chúng tôi hỗ trợ gì không?</p>
             </div>
         </div>
         <div class="login-messenger">
             <a href="#" class="login-messenger-button" target="_blank"><img src="{{ asset('./images/messenger_icon.png') }}" alt="messenger-icon" class="icon-messenger">&nbsp; Đăng nhập vào Messenger</a>
             <p class="chat-with-hapo">Chat với HapoLearn trong Messenger</p>
         </div>
     </div>
 </div>
