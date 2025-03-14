TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER update_branch_rating\nAFTER INSERT ON Food\nFOR EACH ROW\nBEGIN\n    UPDATE Branch\n    SET branch_rating = (\n        SELECT AVG(food_rating) FROM Food WHERE branch_id = NEW.branch_id\n    )\n    WHERE branch_id = NEW.branch_id;\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=1741970689695894
