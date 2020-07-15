help:
		@echo ""
		@echo "usage: make COMMAND"
		@echo ""
		@echo "Commands:"
		@echo "  clean               Remove vendor directory"
		@echo "  install             Install Dependencies"
		@echo "  test                Run all tests"


install:
	php composer.phar install

clean:
	@rm -rf vendor

test:
	./vendor/bin/phpunit src/tests --colors

