-- create database MUSIC;
use id16302356_music;

create table reviewer (
	ma_tgia int unsigned not null primary key,
    ten_tgia varchar(100) not null,
    hinh longblob null
);

create table genres (
	ma_tloai int unsigned not null primary key,
    ten_tloai varchar(30) not null
);

create table reviews (
	ma_bviet int unsigned not null primary key,
    tieude varchar(200) not null,
    ten_bhat varchar(100) not null,
    ma_tloai int unsigned not null,
    tomtat varchar(500) not null,
    baiviet varchar(2000) null,
    ma_tgia int unsigned not null,
    ngayviet date not null,
    ten_hinh varchar(100)
);


insert into Reviewer(ma_tgia, ten_tgia) value (1, "Nhacvietplus");
insert into Reviewer(ma_tgia, ten_tgia) value (2, "Sưu tầm");
insert into Reviewer(ma_tgia, ten_tgia) value (3, "Sandy");
insert into Reviewer(ma_tgia, ten_tgia) value (4, "Lê Trung Ngân");
insert into Reviewer(ma_tgia, ten_tgia) value (5, "Khánh Ngọc");
insert into Reviewer(ma_tgia, ten_tgia) value (6, "Night Stalker");
insert into Reviewer(ma_tgia, ten_tgia) value (7, "Phạm Phương Anh");



insert into Genres(ma_tloai, ten_tloai) values (1, "Nhạc trẻ");
insert into Genres(ma_tloai, ten_tloai) values (2, "Nhạc trữ tình");
insert into Genres(ma_tloai, ten_tloai) values (3, "Nhạc cách mạng");
insert into Genres(ma_tloai, ten_tloai) values (4, "Nhạc thiếu nhi");
insert into Genres(ma_tloai, ten_tloai) values (5, "Nhạc quê hương");
insert into Genres(ma_tloai, ten_tloai) values (6, "POP");
insert into Genres(ma_tloai, ten_tloai) values (7, "Rock");
insert into Genres(ma_tloai, ten_tloai) values (8, "R&B");


insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values
(1, "Lòng mẹ", "Lòng mẹ", 2,"Và mẹ ơi đừng khóc nhé! Cả đời này mẹ đã khóc nhiều lắm rồi, hãy cười lên vì con đã trưởng thành! Con sẽ lại về dậy sớm nấu cơm cho mẹ, nấu nước cho mẹ tắm như ngày xưa. \“Dù cho vai nắng nhưng lòng thương chẳng nhạt màu, vẫn mơ quay về vui vầy dưới bóng mẹ yêu\”", 	1,"2012/7/23");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (2, 
"Cảm ơn em đã rời xa anh", "Vết mưa", 2,
"Cảm ơn em đã cho anh những tháng ngày hạnh phúc, cho anh biết yêu và được yêu. Em cho anh được nếm trải hương vị ngọt ngào của tình yêu nhưng cũng đầy đau khổ và nước mắt. Những tháng ngày đó có lẽ suốt cuộc đời anh không bao giờ quên", 	
3, "2012/2/12");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (3,
"Cuộc đời có mấy ngày mai?", "Phôi pha", 2, 
"Đêm nay, trời quang mây tạnh, trong người nghe hoang vắng và tôi ngồi đây \“Ôm lòng đêm, Nhìn vầng trăng mới về\” mà ngậm ngùi \“Nhớ chân giang hồ. Ôi phù du, từng tuổi xuân đã già\”", 
4, "2014/3/13");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (4, 
"Quê tôi!", "Quê hương", 5,
"Quê hương là gì mà chở đầy kí ức nhỏ xinh. Có đám trẻ nô đùa bên nhau dưới gốc ổi nhà bà Năm giữa trưa nắng gắt chỉ để chờ bà đi vắng là hái trộm. Có hai anh em tôi bì bõm lội sình bắt cua đem về nhà cho mẹ nấu canh, nấu cháo… Có ba chị em tôi lục đục tự nấu ăn khi mẹ vắng nhà. Có anh tôi luôn dắt tôi đi cùng đường ngõ xóm chỉ để em được vui. Có cả những trận cãi nhau nảy lửa của ba anh em nữa…",
5, "2014/2/20");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (5, 
"Đất nước", "Đất nước", 5,
"Đã bao nhiêu lần tôi tự hỏi: liệu trên Thế giới này có nơi nào chiến tranh tang thương mà lại rất đổi anh hùng như nước mình không? Liệu có mảnh đất nào mà mỗi tấc đất hôm nay đã thấm máu xương của những thế hệ đi trước nhiều như nước mình không? Và, liệu có một đất nước nào lại có nhiều bà mẹ đau khổ nhưng cũng hết sức gan góc như đất nước mình không?",
1, "2010/5/25");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (6, 
"Hard Rock Hallelujah", "Hard Rock Hallelujah", 7,
"Những linh hồn đang lạc lối, mù quáng mất phương hướng trong cõi trần gian đầy nghiệt ngã hãy nên lắng nghe \"Hard Rock Hallelujah\" để có thể quên tất cả mọi thứ để tìm về đúng bản chất sâu thẳm nhất trong tâm hồn chính mình!",
6, "2013/9/12");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (7, 
"The Unforgiven", "The Unforgiven", 7,
"Lâu lắm rồi mới nghe lại The Unforgiven II, vì bài này không phải là bài mà tôi thích. Anh bạn tôi lúc trước, đi đâu cũng nghêu ngao bài này ấy, chỉ tại vì hắn đang... thất tình mà lị. Mà sao Metallica có The Unforgiven rồi lại có thêm bài này chi nữa vậy không biết nữa, làm cho tôi cảm thấy hình như hơi bị đúng so với tâm trạng của tôi lúc này.",
1, "2010/5/25");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (8, 
"Nơi tình yêu bắt đầu", "Nơi tình yêu bắt đầu", 1,
"Nhiều người sẽ nghĩ làm gì có yêu nhất và làm gì có yêu mãi. Ừ! Chẳng có gì là mãi mãi cả, vì chúng ta không trường tồn vĩnh cửu",
1, "2014/2/3");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (9, 
"Love Me Like There’s No Tomorrow", "Love Me Like There’s No Tomorrow", 8,
"Nếu ai đã từng yêu Queen, yêu cái chất giọng cao, sắc sảo như một vết cắt thật ngọt ẩn giấu bao cảm xúc mãnh liệt của Freddie chắc không thể không \"điêu đứng\" mỗi khi nghe Love Me Like There’s No Tomorrow.",
1, "2013/2/26");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (10, 
"I\'m stronger", "I\'m stronger", 7,
"Em không phải là người giỏi giấu cảm xúc, nhưng em lại là người giỏi đoán biết cảm xúc của người khác vậy nên đừng cố nói nhớ em, rằng mọi thứ chỉ là do hoàn cảnh. Và cũng đừng dối em rằng anh đã từng yêu em. Em nhắm mắt cũng cảm nhận được mà, thật đấy",
2, "2013/8/21");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (11, 
"Ôi Cuộc Sống Mến Thương", "Ôi Cuộc Sống Mến Thương", 5,
"Có một câu nói như thế này \"Âm nhạc là một cái gì khác lạ mà hầu như tôi muốn nói nó là một phép thần diệu.Vì nó đứng giữa tư tưởng và hiện tượng, tinh thần và vật chất, mọi thứ trung gian mơ hồ thế đó mà không là thế đó giữa các sự vật mà âm nhạc hòa giải\"",
2, "2011/10/9");
insert into Reviews(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values (12, 
"Cây và gió", "Cây và gió", 7,
"Em và anh, hai đứa quen nhau thật tình cờ. Lời hát của anh từ bài hát “Cây và gió” đã làm tâm hồn em xao động. Nhưng sự thật phũ phàng rằng em chưa bao giờ nói cho anh biết những suy nghĩ tận sâu trong tim mình. Bởi vì em nhút nhát, em không dám đối mặt với thực tế khắc nghiệt, hay thực ra em không dám đối diện với chính mình.",
7, "2013/12/5");

ALTER TABLE Reviews ADD FULLTEXT tim_kiem(tieude, ten_bhat);

UPDATE reviews SET ten_hinh = concat("bviet_", ma_bviet, ".jpg");

-- select * from Reviewer;

-- select * from Genres;

-- SELECT 
--   TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
-- FROM
--   INFORMATION_SCHEMA.KEY_COLUMN_USAGE
-- WHERE
--   REFERENCED_TABLE_SCHEMA = 'music' AND
--   REFERENCED_TABLE_NAME = 'Reviews' AND
--   REFERENCED_COLUMN_NAME = 'ma_tgia';

-- SHOW INDEX FROM Reviews FROM music;
-- select * from Reviews;

-- select ten_bhat from Reviews r 
-- join Genres g on r.ma_tloai = g.ma_tloai
-- where ten_tloai = "Nhạc trữ tình"; 

-- select ten_bhat from Reviews r 
-- join Reviewer g on r.ma_tgia = g.ma_tgia
-- where ten_tgia = "Nhacvietplus"; 

-- select ma_bviet, tieude, ten_bhat, er.ten_tgia, ge.ten_tloai, ngayviet from Reviews ws
-- left join Reviewer er on ws.ma_tgia=er.ma_tgia
-- left join Genres ge on ws.ma_tloai=ge.ma_tloai;

-- select ge.ma_tloai,ten_tloai, count(re.ma_tloai) as tong from Genres ge
-- join Reviews re on ge.ma_tloai=re.ma_tloai
-- group by re.ma_tloai
-- order by tong desc
-- limit 1;

-- select Reviewer.ten_tgia, count(distinct Reviews.ma_tloai) as tongTheloai
-- from Reviews
-- left join Reviewer on Reviews.ma_tgia=Reviewer.ma_tgia
-- left join Genres on Reviews.ma_tloai=Genres.ma_tloai
-- group by Reviews.ma_tgia
-- having count(distinct Reviews.ma_tloai) >= 2
-- order by tongTheloai desc;



-- select * from Reviews
-- where match (tieude) AGAINST ('yêu + thương + anh + em' IN NATURAL LANGUAGE MODE);

-- select * from Reviews
-- where match (tieude, ten_bhat) AGAINST ('"yêu" "thương" "anh" "em"' IN BOOLEAN MODE);

-- SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
-- FROM Reviews r1
-- left join Reviewer r2 on r1.ma_tgia=r2.ma_tgia
-- left join Genres g on r1.ma_tloai=g.ma_tloai
-- where match (tieude, ten_bhat) AGAINST ('"mẹ"' IN BOOLEAN MODE);

-- SELECT MAX(ma_bviet) FROM Reviews;

-- SELECT ma_bviet, tieude, r2.ten_tgia, ngayviet, ten_bhat, g.ten_tloai, tomtat
-- FROM Reviews r1
-- LEFT JOIN Reviewer r2 on r1.ma_tgia=r2.ma_tgia
-- LEFT JOIN Genres g on r1.ma_tloai=g.ma_tloai
-- WHERE ma_bviet = (SELECT MAX(ma_bviet) FROM Reviews);

