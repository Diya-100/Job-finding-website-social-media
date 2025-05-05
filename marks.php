<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marks Table</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 40px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #999;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Marks Evaluation Table</h2>
    <div id="marks-table"></div>

    <script>
        const data = [
            {
                mark: "2",
                justification: "Created a comments table with fields like id, job_id, user_name, comment_text, timestamp using SQL query which records all the comments and replies from users on a post",
                internal: "job_finder.sql"
            },
            {
                mark: "3",
                justification: "Wrote PHP code to receive POST request containing comment data and used input validation to prevent SQL injection or empty submissions",
                internal: "add_comment.php"
            },
            
            {
                mark: "4",
                justification: "Added comment form under each job post to allow users to submit a comments and wrote code fetch and display comments for each job post",
                internal: "browsejob.php"
            },
            {
                mark: "3",
                justification: "Added a reply form under each comment for users to submit replies and wrote code to diplay the replies under each comment for a specific job post",
                internal: "browsejob.php"
            },
            {
                mark: "3",
                justification: " Used a nested structure to show replies under each comment and store the threads seperately in database ",
                internal: "browsejob.php"
            }
        
        ];

        const table = d3.select("#marks-table")
            .append("table");

        const thead = table.append("thead");
        const tbody = table.append("tbody");

        // Define columns
        const columns = ["mark", "justification", "internal"];

        // Append headers
        thead.append("tr")
            .selectAll("th")
            .data(columns)
            .enter()
            .append("th")
            .text(d => d);

        // Append rows and data
        const rows = tbody.selectAll("tr")
            .data(data)
            .enter()
            .append("tr");

        rows.selectAll("td")
            .data(row => columns.map(col => row[col]))
            .enter()
            .append("td")
            .text(d => d);
    </script>
</body>
</html>
