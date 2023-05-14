import React, { PropsWithChildren } from 'react';
import Header from '@/Components/Page/Header';
import MaxWidthContainer from '@/Components/Page/MaxWidthContainer';

type PageProps = {
	activeHeader: string;
	title: string;
};

const PageWrapper: React.FC<PropsWithChildren<PageProps>> = ({ activeHeader, title, children }) => (
	<>
		<Header active={activeHeader} />
		<MaxWidthContainer className="mt-8">
			<main>
				<h1>{title}</h1>
				{children}
			</main>
		</MaxWidthContainer>
	</>
);

export default PageWrapper;
