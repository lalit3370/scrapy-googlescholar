# scrapy-googlescholar

Steps for Installation (on linux)


1. We first need to install python modules,Scrapyrt, Docker,
Xampp.
2. In the terminal run following commands:
1. pip install scrapy –user
2. pip install scrapyrt --user
3. pip install scrapy-splash –user
4. pip install scraperapi-sdk –user
3. Docker installation differs on different type of OS in use. You
may refer to this link on how to install docker on linux.
https://docs.docker.com/engine/install/ubuntu/
4. Pulling splash image
1. sudo docker pull scrapinghub/splash
5. Copy topl_project from my project to a directory of your
choosing.
6. For installing xampp, refer to this link https://vitux.com/how-to-install-xampp-on-your-ubuntu-18-04-lts-system/
7. Copy the ‘Website’ folder in my project files and paste it inside
‘htdocs’ folder which is present the xampp installation
directory. It should be (/opt/lampp/htdocs/)
8. Create a Scraper API account if you don't want to get banned from google
9. Copy your API key and paste it in topl_project/topl_project/spiders/1.py lines 22 and 52
10. However, If you want to use it directly, you can remove scraper api module and replace 'client.scrapyGet(url)' to just 'url' in lines 23 and 53


Steps for executing the project


In the terminal run the following commands, each in a new instance
of the terminal, as they all are process we need to run in background
1. sudo dockerd (start docker)
2. sudo docker run -it -p 8050:8050 --rm scrapinghub/splash
(running splash on docker container)
3. sudo xampp start (starting xampp server)
4. Go to the directory of the spider (topl_project)and then run
scrapyrt -p 3000
5. Open the browser, enter the follwing url:
localhost/Website/main.html
6. After the page loads, enter the desired Google Scholar Id into
the input box and click enter.
7. The page loads with the papers written by the user, along with
name of the user, and user image.
8. On further click any one of the paper, we can see the citations
for that paper (currently only 1st page of result is scraped for
citations).
